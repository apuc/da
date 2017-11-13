Миграции для user:

1. yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
2. yii migrate/up --migrationPath=@yii/rbac/migrations

Для закрытия доступа к админпанели не админам в контролере использовать


              'AccessSecure' =>
                [
                    'class' => AccessSecure::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],


Для формирования транслитерации в названиях в composer.json добавить

        "2amigos/yii2-transliterator-helper": "*"

        В моделях

        public function behaviors()
            {
                return [
                    'slug' => [
                        'class' => 'common\behaviors\Slug',
                        'in_attribute' => 'title',
                        'out_attribute' => 'slug',
                        'translit' => true
                    ],
                ];
            }

ДЛЯ ПОДНЯТИЯ ГОРОДОВ И РЕГИОНОВ

    1) выполнить пиграцию yii migrate/up --migrationPath=@vendor/himiklab/yii2-ipgeobase-component/migrations
    2) В любом контроллере добавить код и запустить этот контроллер
    
            $IpGeoBase = new IpGeoBase();
            $IpGeoBase->updateDB();
            
            
    3) Убрать изменения вконтроллере
    
        
**Для добавления курсов валют ЦБ РФ и их курсов**

    1) Выполнить команду yii cbrf
    2) Выполнить команду yii cbrf/get-valutes
    3) В админке по адресу /secure/currency/currency выбрать Статус "Доступна для показа" для необходимых валют
        данные курсы будут отображены по адресу /exchange
    
**Для добавления курсов криптовалют их курсов**

    1) Выполнить команду yii coin
    2) Выполнить команду yii coin/rates
    3) В админке по адресу /secure/coin/coin выбрать Статус "Доступна для показа" для необходимых криптовалют
            данные курсы будут отображены по адресу /coin
