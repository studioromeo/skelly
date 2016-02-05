<?php

namespace RS\Framework\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr7Middlewares\Middleware\FormatNegotiator;
use Psr7Middlewares\Middleware\LanguageNegotiator;
use RS\TreeBuilder\TreeBuilderInterface;

class GetNodeTreeAction
{
    protected $treeBuilder;
    protected $db;

    /**
     * @param TreeBuilderInterface $treeBuilder
     * @param \PDO $db
     */
    public function __construct(TreeBuilderInterface $treeBuilder, \PDO $db)
    {
        $this->treeBuilder = $treeBuilder;
        $this->db = $db;
    }

    public function dispatch(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {

        $lang = LanguageNegotiator::getLanguage($request);

        $query = $this->db->prepare('SELECT n.id, n.title, n.parent_id from nodes n
INNER JOIN node_attributes na ON na.node_id = n.id
INNER JOIN attribute_values av on na.`attribute_value_id` = av.`id`
where av.`attribute_value` = :language;');

        $query->bindParam(':language', $lang);
        $query->execute();

        $data = $query->fetchAll(\PDO::FETCH_ASSOC);


        $neg = new FormatNegotiator();

        $contentType = $neg->getFormat($request);
        switch($contentType) {
            case 'xml':
                $xml = new \SimpleXMLElement('<root/>');
                array_walk_recursive($this->treeBuilder->build($data), array($xml, 'addChild'));
                $response->getBody()->write($xml->asXML());
                break;
            default:
                $response->getBody()->write(json_encode($this->treeBuilder->build($data)));
                break;
        }

        return $response->withoutHeader('Content-Type'); // Remove the Content-Type Header
    }
}
