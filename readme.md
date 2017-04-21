# CompanyDB API - Powered by Lumen

### Create new company
Endpoint `POST /companies`
- Return created company

Fields: name, address, city, country, email (not required), phone number (not required)

```
$ curl -i -X POST https://api.companydb.io/companies -d '{"name":"Some Company","address":"An address","city":"Great City","country":"Better Country","email":"mail@example.com","phone":"123 123 123 123"}'
```

Result

```
{
   "name":"Some Company",
   "address":"An address",
   "city":"Great City",
   "country":"Better Country",
   "email":"mail@example.com",
   "phone":"123 123 123 123",
   "updated_at":"2017-04-21 11:33:49",
   "created_at":"2017-04-21 11:33:49",
   "id":11
}
```

### List companies
Endpoint: `GET /companies`

- Returns a full collection of all companies

```
$ curl -i -X GET https://api.companydb.io/companies
```

```
{
   "data":[
      {
         "id":1,
         "name":"Gleason Inc",
         "address":"22731 Cole Landing Suite 077\nWisozkport, TN 02282",
         "city":"Lockmanland",
         "country":"Moldova",
         "email":"buddy.oconnell@cummings.com",
         "phone":"543.769.5540 x2202",
         "created_at":"2017-04-21 11:01:19",
         "updated_at":"2017-04-21 11:01:19"
      },
      {
         "id":2,
         "name":"Marvin-Howell",
         "address":"3520 Weldon Islands Suite 140\nVonRuedenborough, MS 83409-5064",
         "city":"Lake Earnestland",
         "country":"Myanmar",
         "email":"will.tad@treutel.com",
         "phone":"542-558-2953 x9712",
         "created_at":"2017-04-21 11:01:19",
         "updated_at":"2017-04-21 11:01:19"
      }
   ]
}
```

### Get details about a company
Endpoint: `GET /companies/:id`  
- Returns a company including related people

Using CURL

```
$ curl -i -X GET https://api.companydb.io/companies/123
```

Result

```
{
   "id":1,
   "name":"Gleason Inc",
   "address":"22731 Cole Landing Suite 077\nWisozkport, TN 02282",02282",
   "city":"Lockmanland",
   "country":"Moldova",
   "email":"buddy.oconnell@cummings.com",
   "phone":"543.769.5540 x2202",
   "people":[
      {
         "id":1,
         "name":"Wendell Wilkinson II",
         "role":"founder"
      },
      {
         "id":2,
         "name":"Dr. Bonnie Torp",
         "role":"owner"
      }
   ]
}
```

### Update a company
Endpoint `PUT /companies/:id`

```
$ curl -i -X PUT https://api.companydb.io/companies/11 -d '{"name":"Some Company Inc","address":"New address","city":"Great City","country":"Better Country","email":"mail@example.com","phone":"123 123 123 123"}' 
```

Result

```
{
   "id":11,
   "name":"Some Company Inc",
   "address":"New address",
   "city":"Great City",
   "country":"Better Country",
   "email":"mail@example.com",
   "phone":"123 123 123 123",
   "created_at":"2017-04-21 11:33:49",
   "updated_at":"2017-04-21 11:37:27"
}
```

### Add person to company
Endpoint `POST /companies/:id/people`

```
$ curl -i -X POST https://api.companydb.io/companies/11/people -d '{"name":"John Doe","role":"founder"}'
```

Result

```
{
   "data":{
      "id":32,
      "name":"John Doe",
      "role":"founder"
   }
}
```
