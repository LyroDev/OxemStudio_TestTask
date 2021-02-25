<?php


class Farm
{
    public string $name;
    public array $animals = array();
    public array $production = array();
    public array $animalSchemes = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function addAnimalScheme(string $type, int $minProduction, int $maxProduction){
        $this->animalSchemes[$type] = [$minProduction, $maxProduction];
        $this->production[$type] = 0;
    }

    public function addAnimals(string $type, int $amount){
        if (array_key_exists($type, $this->animalSchemes)){
            for ($i = 1; $i <= $amount; $i++){
                $prod = $this->animalSchemes[$type];
                $animal = new Animal($type, $prod[0], $prod[1]);
                array_push($this->animals, $animal);
            }
        }else{
            throw new Exception('Такой схемы животных нет');
        }

    }

    public function collectProduction(){
        foreach ($this->animals as $animal) {
            $this->production[$animal->getType()] += $animal->collect();
        }
    }

    public function getProduction(string $type){
        return $this->production[$type];
    }
}


class Animal
{
    public string $id;
    public string $type;
    public int $minProduction;
    public int $maxProduction;

    public function __construct(string $type, int $minProduction, int $maxProduction)
    {
        $this->id = uniqid();
        $this->type = $type;
        $this->minProduction = $minProduction;
        $this->maxProduction = $maxProduction;
    }

    public function getType()
    {
        return $this->type;
    }

    public function collect()
    {
        return random_int($this->minProduction, $this->maxProduction);
    }
}

//Создаем ферму
$farm = new Farm("Uncle Bob's farm");

//Добавляем животных
$farm->addAnimalScheme("Корова", 8, 12);
$farm->addAnimals("Корова", 10);
$farm->addAnimalScheme("Курица", 0,1);
$farm->addAnimals("Курица", 20);
//Собираем продукцию
$farm->collectProduction();
//Получаем продукцию
$milk = $farm->getProduction("Корова");
$eggs = $farm->getProduction("Курица");
echo "Всего собрано: $milk л. молока и $eggs яиц";
