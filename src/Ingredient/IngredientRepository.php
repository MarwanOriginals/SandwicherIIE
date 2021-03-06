<?php
namespace Ingredient;
use PDO;

class IngredientRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query(
            'SELECT * FROM "ingredient"')
            ->fetchAll(PDO::FETCH_OBJ);
            
        $ingredients = [];
        foreach ($rows as $row) {
            $ingredient = new Ingredient();
            $ingredient
                ->setId($row->id)
                ->setLabel($row->label)
                ->setAvailable($row->available)
                ->setPrice($row->price)
                ->setImageLink($row->image_link);

            $ingredients[] = $ingredient;
        }

        return $ingredients;
    }

    public function findOneById($ingredientId)
    {        
        $query = $this->connection->prepare(
            'SELECT * FROM "ingredient" WHERE id = :id');
        
        $query->bindValue(':id', $ingredientId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $ingredient = new Ingredient();

        $row ? $ingredient
            ->setId($row['id'])
            ->setLabel($row['label'])
            ->setAvailable($row['available'])
            ->setPrice($row['price'])
            ->setImageLink($row['image_link'])
            : null;

        return $ingredient;
    }

    public function findOneByLabel($ingredientLabel)
    {        
        $query = $this->connection->prepare(
            'SELECT * FROM "ingredient" WHERE label = :label');
        
        $query->bindValue(':label', $ingredientLabel, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();
        $ingredient = new Ingredient();

        $row ? $ingredient
            ->setId($row['id'])
            ->setLabel($row['label'])
            ->setAvailable($row['available'])
            ->setPrice($row['price'])
            ->setImageLink($row['image_link'])
            : null;

        return $ingredient;
    }

    public function updateIngredient(Ingredient $ingredient)
    {
        $query = $this->connection->prepare(
            'UPDATE ingredient
            SET label = :label,
                available = :available,
                price = :price,
                image_link = :image_link
            WHERE id = :id');

        $query->bindValue(':id', $ingredient->getId());
        $query->bindValue(':label', $ingredient->getLabel());
        $query->bindValue(':available', $ingredient->getAvailable());
        $query->bindValue(':price', $ingredient->getPrice());
        $query->bindValue(':image_link', $ingredient->getImageLink());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $ingredient;
    }

    public function createIngredient(Ingredient $newIngredient)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "ingredient"(label, available, price, image_link) 
            VALUES (:label , :available, :price, :image_link)');
        
        $query->bindValue(':label', $newIngredient->getLabel());
        $query->bindValue(':available', $newIngredient->getAvailable());
        $query->bindValue(':price', $newIngredient->getPrice());
        $query->bindValue(':image_link', $newIngredient->getImageLink());

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        $newIngredient->setId($this->connection->lastInsertId());
        return $newIngredient;
    }

    public function deleteIngredient(Ingredient $ingredientToDelete)
    {
        $query = $this->connection->prepare('DELETE FROM "ingredient" WHERE id = :id');
        $query->bindValue(':id', $ingredientToDelete->getId());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $result;
    }
}
