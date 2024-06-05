<?php
namespace models;

require_once '../models/utils.php';
use PDO;
use PDOException;

class User_Model {

    private $db;

    public function __construct() {
        $this->db = Utils::conectar();
    }

    public function createUser($nombre, $apellido, $direccion, $telefono, $email, $password, $codigo_activacion, $imagen_perfil = null) {
        $rol = 'cliente'; // Rol por defecto
        $estado = 'activo'; // Estado por defecto
        try {
            $query = "INSERT INTO usuarios (Nombre, Apellido, Direccion, Telefono, Email, Password, CodigoActivacion, Activado, Rol, Estado, imagen_perfil, fecha_registro) 
                      VALUES (:nombre, :apellido, :direccion, :telefono, :email, :password, :codigo_activacion, 0, :rol, :estado, :imagen_perfil, CURRENT_TIMESTAMP)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':codigo_activacion', $codigo_activacion);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':imagen_perfil', $imagen_perfil);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function activateUser($email) {
        try {
            $query = "UPDATE usuarios SET Activado = 1, CodigoActivacion = NULL WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateUser($userId, $nombre, $apellido, $direccion, $telefono, $email, $rol, $estado, $imagen_perfil = null) {
        try {
            $query = "UPDATE usuarios SET Nombre = :nombre, Apellido = :apellido, Direccion = :direccion, Telefono = :telefono, Email = :email, Rol = :rol, Estado = :estado, imagen_perfil = :imagen_perfil WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':imagen_perfil', $imagen_perfil);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser($userId) {
        try {
            $query = "DELETE FROM usuarios WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllUsers() {
        try {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getUserById($userId) {
        try {
            $query = "SELECT * FROM usuarios WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function banUser($userId) {
        try {
            $query = "UPDATE usuarios SET Estado = 'baneado' WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function unbanUser($userId) {
        try {
            $query = "UPDATE usuarios SET Estado = 'activo' WHERE ID_Usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserByEmailAndCode($email, $codigoActivacion) {
        try {
            $query = "SELECT * FROM usuarios WHERE Email = :email AND CodigoActivacion = :codigo AND Activado = 0";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':codigo', $codigoActivacion);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}





