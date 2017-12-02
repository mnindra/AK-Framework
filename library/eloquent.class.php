<?php

class Eloquent extends Model {

  protected $tableName = "";
  protected $primaryKey = "";
  protected $fillable = [];

  protected function all($join = []) {
    $this->db->select("*");
    $this->db->from($this->tableName);

    foreach ($join as $item) {
      $this->db->join($item['table'], $item['condition']);
    }

    return $this->db->execute()->result();
  }

  protected function find($id, $join = []) {
    $this->db->select("*");
    $this->db->from($this->tableName);

    foreach ($join as $item) {
      $this->db->join($item['table'], $item['condition']);
    }

    $this->db->where($this->primaryKey . ' = ' . $id);
    return $this->db->execute()->row();
  }

  protected function where($condition, $join = []) {
    $this->db->select("*");
    $this->db->from($this->tableName);

    foreach ($join as $item) {
      $this->db->join($item['table'], $item['condition']);
    }

    $this->db->where($condition);
    return $this->db->execute()->row();
  }

  protected function create($data) {
    $insert_data = [];
    foreach ($this->fillable as $item) {
      $insert_data[$item] = $data[$item];
    }

    $this->db->insert($this->tableName, $insert_data);
    $this->db->execute();
  }

  protected function update($data, $id) {
    $update_data = [];
    foreach ($this->fillable as $item) {
      $update_data[$item] = $data[$item];
    }

    $this->db->where($this->primaryKey . ' = ' . $id);
    $this->db->update($this->tableName, $update_data);
    $this->db->execute();
  }

  protected function destroy($id) {
    $this->db->delete($this->tableName);
    $this->db->where($this->primaryKey . ' = ' . $id);
    $this->db->execute();
  }
}