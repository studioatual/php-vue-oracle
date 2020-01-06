<?php

namespace App\Controllers\Api;

use PDO;
use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StockController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $args = $request->getQueryParams();
        $current_page = isset($args['page']) ? intval($args['page']) : 1;
        $per_page = isset($args['per_page']) ? intval($args['per_page']) : 15;
        $order = isset($args['order']) ? $args['order'] : 'tag';
        $sort = isset($args['sort']) ? $args['sort'] : 'asc';
        $search = isset($args['search']) ? $args['search'] : null;
        $type = isset($args['type']) ? $args['type'] : null;

        $where = '';
        if ($search && $type) {
            $where = " WHERE STK." . strtoupper($type) . " LIKE '%" . strtoupper($search) . "%' ";
        }

        $total = $this->getTotal($where);
        $last_page = (($total%$per_page)==0) ? $total/$per_page : floor($total/$per_page) + 1;
        $next_page = ($current_page + 1) > $last_page ? null : $current_page + 1;
        $prev_page = ($current_page - 1 > 0) ? $current_page - 1 : null;

        $from = ($current_page - 1) * $per_page + 1;
        $to = $from + $per_page - 1;

        if ($from > $total) {
            $response->getBody()
                ->write(json_encode([
                    'current_page' => $current_page,
                    'next_page' => null,
                    'prev_page' => $last_page,
                    'last_page' => $last_page,
                    'per_page' => $per_page,
                    'from' => null,
                    'to' => null,
                    'total' => $total,
                    'order' => $order,
                    'sort' => $sort,
                    'data' => []
                ]));

            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json');
        }

        try {
            $result = $this->db->query("SELECT TAG
                        , DESCRICAO
                        , CUSTO_MEDIO
                        , QUANTIDADE_KG
                        FROM (SELECT row_number()
                                    OVER(ORDER BY STK.".strtoupper($order)." ".strtoupper($sort).") line,
                                    STK.* FROM STOCK STK $where)
                        WHERE line BETWEEN ".$from." AND ".$to);

            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $response->getBody()
                ->write(json_encode([
                    'current_page' => $current_page,
                    'next_page' => $next_page,
                    'prev_page' => $prev_page,
                    'last_page' => $last_page,
                    'per_page' => $per_page,
                    'from' => $from,
                    'to' => $to,
                    'total' => $total,
                    'order' => $order,
                    'sort' => $sort,
                    'data' => $data
                ]));

            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json');

        } catch (PDOException $e) {

            $response->getBody()
                ->write(json_encode(['error' => $e->getMessage()]));

            return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }
    }

    private function getTotal($where)
    {
        try {
            $result = $this->db->query("SELECT COUNT(*) AS TOTAL FROM STOCK STK $where");
            return intval($result->fetchColumn(0));
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getAllProducts(Request $request, Response $response)
    {
        try {

            $result = $this->db->query("SELECT
                descricao
                , custo_medio
                FROM STOCK
                ORDER BY DESCRICAO");

            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $response->getBody()->write(json_encode($data));

            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json');

        } catch (PDOException $e) {

            $response->getBody()
                ->write(json_encode(['error' => $e->getMessage()]));

            return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }
    }
}
