docker build -t exam-sensor .

docker run -p 8000:8000 -v /Users/yarusha/Works/Personal/ExamFullStack/sensor-app:/sensor-app --rm exam-sensor
