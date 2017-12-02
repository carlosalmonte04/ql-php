<?php
  class EnergyConsumption {
    public $id;
    public $kw;
    public $date;

    public function __construct($id, $kw, $date) {
      $this->id      = $id;
      $this->kw  = $kw;
      $this->date = $date;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM energy_consumptions');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $energyConsumption) {
        $list[] = new EnergyConsumption($energyConsumption['id'], $energyConsumption['kw'], $energyConsumption['date']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM energy_consumptions WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $energyConsumption = $req->fetch();

      return new EnergyConsumption($energyConsumption['id'], $energyConsumption['kw'], $energyConsumption['date']);
    }
  }
?>