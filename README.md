Задание:
API для сенсоров
1. Возможность создать/изменять/удалять сенсоры (с уникальными идентификаторами), принимать результаты с сенсоров по идентификатору, возвращать результаты.
2. Хранение результатов - дробные либо целые числа - в БД.
3. Получение до n последних результатов (n задается при создании или изменении сенсора)
4. Автоматическая чистка "лишних" (старых) результатов


docker build -t exam-sensor .
docker compose up

GET: 
(получение всех сенсоров)
http://localhost:8000/api/sensors

(получение данных по одному сенсору)
http://localhost:8000/api/sensor/1

POST:
(создание сенсора)
http://localhost:8000/api/sensors/create
{   
    "name": "TestSensor",
    "count_params": 10
}

DELETE:
(удаляет сенсор и все его результаты)
http://localhost:8000/api/sensor/1

PUT: 
(изменение данных самого сенсора)
http://localhost:8000/api/sensor/1
{   
"name": "TestSensor123",
"count_params": 10
}

POST:
(добавление данных для сенсора)
http://localhost:8000/api/sensor/5/create
{
    "value": 123.22
}

GET: 
(Получение значений по сенсору)
http://localhost:8000/api/sensor/5/params
