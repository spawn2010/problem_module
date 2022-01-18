<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Приложение для решений проблем пользователей</h1>
    <h3 align="center">Необходимо разработать приложение, которое позволит различным пользователям добавлять свои проблемы, получая конкретные решения других пользователей с возможностью оценки этих решений.</h3>
</p>


Функионал системы:
-------------------
- Авторизация и регистрация пользователей.
</br>
- Возможности роли администратора: 
</br>
− Выставление рейтинга каждой отдельно проблеме.
</br>
− Редактирование собственного профиля и загрузка аватара.
  </br>
− Просмотр/добавление/удаление/редактирование пользователей.
- Возможности роли пользователя:
 </br>
− Добавление инцидентов.
 </br>
 − Принятие конкретного решения по каждому инциденту.
</br>
− Редактирование собственного профиля и загрузка аватара.
   </br>
- Возможности всех пользователей:
  </br>
  − Просмотр любого инцидента с возможностью выставления оценки.
  </br>
  − Просмотр профиля любого пользователя.
    </br>
  − Добавление собственного решения к любой проблеме.
   </br>
- Бекэнд написан на Yii2

Роли в системе:
-------------------
- Пользователь – посетитель, имеющий учетную запись в системе и авторизованный в ней.
</br>
- Администратор – пользователь, имеющий права на добавление/редактирование/удаление пользователей, выставления рейтинга проблем.

Первый запуск:
-------------------
1. Переименовать docker-compose.override.sample.yml в docker-compose.override.yml.
2. docker-compose up -d
3. php yii migrate
4. открыть localhost:8003
5. зарегестрироваться в системе