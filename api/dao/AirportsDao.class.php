<?php

require_once dirname(__FILE__) . "/BaseDao.class.php";

class AirportsDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("airports");
    }

    public function get_airport_by_id($id)
    {
        return $this->query_unique("SELECT * FROM airports WHERE airportid=:id", ["id" => $id]);
    }

    public function delete_airport($id)
    {
        return $this->query_unique("DELETE FROM airports WHERE airportid=:id", ["id" => $id]);
    }

    public function return_airport_by_city($city)
    {
        return $this->query_unique("SELECT * FROM airports WHERE airport_city=:city", ["city" => $city]);
    }

    public function insert_new_airport($table, $data)
    {
        return $this->insert($table, $data);
    }

    public function get_airports($search, $offset, $limit, $order)
    {

        list($order_column, $order_direction) = self::parse_order($order);

        return $this->query("SELECT * FROM airports
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}",
            ["airport_name" => strtolower($search)]);
    }

    public function update_airport($airportid, $airports)
    {
        $this->update("airports", $airportid, $airports);
    }

    public function execute_update($table, $id, $entity, $id_column = "airportid")
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

}
