# Задание: Ферма ООП

## Дано 
* В хлеву живут 10 коров и 20 кур
* Корова может давать 8-12 литров молока за один надой
* Курица может нести 0-1 яйцо за одну кладку
* У каждой коровы и курицы есть уникальный регистрационный номер

## Задача
Реализовать, используя php, объектно-ориентированную систему: прототип сбора продукции. 
Система должна уметь:
* Добавлять животных в хлев
 ```php
public function addAnimalScheme(string $type, int $minProduction, int $maxProduction)
{
    $this->animalSchemes[$type] = [$minProduction, $maxProduction];
    $this->production[$type] = 0;
}

public function addAnimals(string $type, int $amount)
{
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
```
* Собирать продукцию у всех животных, зарегистрированных в хлеву
 ```php
public function collectProduction()
{
    foreach ($this->animals as $animal) {
        $this->production[$animal->getType()] += $animal->collect();
    }
}
```
* Подсчитывать общее кол-во собранной продукции
 ```php
public function getProduction(string $type)
{
    return $this->production[$type];
}
```

## Результат запуска скрипта
При запуске скрипта main.php в консоли:
* Система должна добавить животных в хлев 
 ```php
//Создаем ферму
$farm = new Farm("Uncle Bob's farm");
//Добавляем схемы животных
$farm->addAnimalScheme("Корова", 8, 12);
$farm->addAnimalScheme("Курица", 0, 1);
//Добавляем животных
$farm->addAnimals("Корова", 10);
$farm->addAnimals("Курица", 20);
```
* Произвести сбор продукции (подоить коров и собрать яйца у кур)
 ```php
$farm->collectProduction();
```
* Вывести на экран общее кол-во собранных шт. яиц и литров молока
 ```php
$milk = $farm->getProduction("Корова");
$eggs = $farm->getProduction("Курица");
echo "Всего собрано: $milk л. молока и $eggs яиц";
//Всего собрано: 96 л. молока и 11 яиц
```
