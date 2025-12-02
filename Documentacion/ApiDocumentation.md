# API

## Client

### `/api/v1/users.php`

POST - Comprobar si existe un usuario por su nombre y contraseña

#### Parameters

Nothing

#### Request body

```json
{
    "name": "Joselu",
    "password": "123456",
}
```

#### Response

```json
{
    "sucess": true,
    "data": {
        "id": "1",
        "name": "Joselu",
        "creation_date": "2025-11-20 14:52:19.789564",
    },
    "message": "Datos obtenidos exitosamente",
}
```


























### `/api/v1/clients/{id}/`

GET - Retrieve a client

#### Parameters

- `id` - The client id

#### Request body

```json
{}
```

#### Response

```json
{
    "id": 1,
    "alias": "Client 1",
    "name": "Client 1 description",
    "logo": {
        "dark": "http://localhost:8000/media/clients/1/logo_dark.png",
        "light": "http://localhost:8000/media/clients/1/logo_light.png"
    },
}
```

## Users

### `/api/v1/users/`

GET - List users

#### Parameters

- `query` - The search query by `email`, `first name` or `last name`. Default is `""`.
- `page` - The page number. Default is `1`.
- `perPage` - The number of items per page. Default is `10`.
- `orderBy` - The field to order by. Default is `email`. Possible values are `email`, `first name`, `last name`, `is active` and `created at`.
- `order` - The order. Default is `asc`. Possible values are `asc` and `desc`.

#### Request body

```json
{}
```

#### Response

```json
{
    "page": 1,
    "total": 12,
    "perPage": 10,
    "lastPage": 2,
    "results": [
        {
            "id": 1,
            "email": "foo@boo.com",
            "firstName": "Foo",
            "lastName": "Boo",
            "isActive": true,
            "roleId": 1,
            "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
        },
    ]
}
```

### `/api/v1/users/{id}/`

GET - Retrieve a user

#### Parameters

- `id` - The user id

#### Request body

```json
{}
```

#### Response

```json
{
    "id": 1,
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
}
```

### `/api/v1/users/{id}/`

POST - Create a user

#### Parameters

Nothing

#### Request body

```json
{
    "email": "foo@boo.com",
    "password": "password",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1
}
```

#### Response

```json
{
    "id": 1,
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1,
    "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
}
```

### `/api/v1/users/{id}/`

PUT - Update a user

#### Parameters

- `id` - The user id

#### Request body

```json
{
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1
}
```

#### Response

```json
{
    "id": 1,
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1,
    "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
}
```

### `/api/v1/users/{id}/`

DELETE - Delete a user

#### Parameters

- `id` - The user id

#### Request body

```json
{}
```

#### Response

```json
{}
```

### `/api/v1/users/{id}/password/`

PUT - Update a user password

#### Parameters

- `id` - The user id

#### Request body

```json
{
    "password": "password"
}
```

#### Response

```json
{
    "id": 1,
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1,
    "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
}
```

### `/api/v1/users/{id}/enabled/`

PUT - Set user enabled

#### Parameters

- `id` - The user id

#### Request body

```json
{
    "isActive": true
}
```

#### Response

```json
{
    "id": 1,
    "email": "foo@boo.com",
    "firstName": "Foo",
    "lastName": "Boo",
    "isActive": true,
    "roleId": 1,
    "createdAt": "2024-11-29T14:41:35.342Z", // ISO 8601
}
```

## Roles

### `/api/v1/roles/`

GET - List all roles

#### Parameters

Nothing

#### Request body

```json
{}
```

#### Response

```json
[
    {
        "id": 1,
        "name": "admin",
        "permissions": [
            {
                "id": 1,
                "name": "manage-users"
            },
            {
                "id": 2,
                "name": "statistics"
            },
            {
                "id": 3,
                "name": "view"
            }
        ]
    },
    {
        "id": 2,
        "name": "guest",
        "permissions": [
            {
                "id": 3,
                "name": "view"
            }
        ]
    }
]
```