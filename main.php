<?php

//ss

class Farm
{
    public string $name;
    public array $animals = array();
    public int $milk = 0;
    public int $eggs = 0;

    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function addAnimals(int $type, int $amount){
        for ($i = 1; $i <= $amount; $i++){
            $animal = new Animal($type);
            array_push($this->animals, $animal);
        }
    }

    public function collectProduction(){
        foreach ($this->animals as $animal) {
            switch ($animal->getType()){
                case 0:
                    $this->milk += $animal->collect();
                    break;
                case 1:
                    $this->eggs += $animal->collect();
                    break;
                default:
                    break;
            }
        }
    }

    public function getProduction(){
        return [$this->milk, $this->eggs];
    }

}


class Animal
{
    public string $id;
    public int $type;

    public function __construct(int $type)
    {
        $this->id = uniqid();
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function collect(){
        switch ($this->type){
            case 0:
                return random_int(8,12);
            case 1:
                return random_int(0,1);
            default:
                return "default";
        }
    }
}

//Создаем ферму
$farm = new Farm("Uncle Bob's farm");
//Добавляем животных
$farm->addAnimals(0, 10);
$farm->addAnimals(1, 20);
//Собираем продукцию
$farm->collectProduction();
//Получаем продукцию
$production = $farm->getProduction();
echo "Всего собрано: {$production[0]} л. молока и {$production[1]} яиц";
