FROM php

WORKDIR /sensor-app/public

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]


