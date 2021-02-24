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
public function addAnimals(int $type, int $amount){
        for ($i = 1; $i <= $amount; $i++){
            $animal = new Animal($type);
            array_push($this->animals, $animal);
        }
    }
```
* Собирать продукцию у всех животных, зарегистрированных в хлеву
 ```php
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
```
* Подсчитывать общее кол-во собранной продукции
 ```php
public function getProduction(){
        return [$this->milk, $this->eggs];
    }
```

## Результат запуска скрипта
При запуске скрипта main.php в консоли:
* Система должна добавить животных в хлев 
 ```php
//Создаем ферму
$farm = new Farm("Uncle Bob's farm");
//Добавляем животных
$farm->addAnimals(0, 10);
$farm->addAnimals(1, 20);
```
* Произвести сбор продукции (подоить коров и собрать яйца у кур)
 ```php
$farm->collectProduction();
```
* Вывести на экран общее кол-во собранных шт. яиц и литров молока
 ```php
$production = $farm->getProduction();
echo "Всего собрано: {$production[0]} л. молока и {$production[1]} яиц";

```
