<?php

require_once dirname(__FILE__) . "/BaseDao.class.php";

class FlightsDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("flights");
    }

    public function delete_flight($id)
    {
        return $this->query_unique("DELETE FROM flights WHERE flightid=:id", ["id" => $id]);
    }

    public function get_flight_by_id($id)
    {
        return $this->query_unique("SELECT * FROM flights WHERE flightid=:id", ["id" => $id]);
    }

    public function return_flight_by_direction($direction)
    {
        return $this->query_unique("SELECT * FROM flights WHERE flight_direction=:direction", ["direction" => $direction]);
    }

    public function get_flights($search, $offset, $limit, $order)
    {

        list($order_column, $order_direction) = self::parse_order($order);

        return $this->query("SELECT * FROM flights
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}",
            ["flight_direction" => strtolower($search)]);
    }

    public function update_flight($flightid, $flights)
    {
        $this->update("flights", $flightid, $flights);
    }

    public function execute_update($table, $id, $entity, $id_column = "flightid")
    {
        $query = "UPDATE ${table} SET ";
        foreach ($entity as $name => $value) {
            $query .= $name . "= :" . $name . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";

        $stmt = $this->connection->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
    }

    public function insert_new_flight($table, $data)
    {
        return $this->insert($table, $data);
    }

}
