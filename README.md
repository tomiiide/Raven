# Raven

Raven is a simple Curl Wrapper class for making API requests.

### Request Examples
```
  //Simple GET Request

  $raven = new Raven();
  $data = $raven->url('http://api-endpoint')->fly();

  // Simple POST Request
  $data = $raven->url('http://api-endpoint')->type('POST')->data([
    'limit' => 5,
    'date' => '21/04/2013'
  ])->headers([
    'API-KEY' => 'Juhb743ysh34js23kn2ifhdJGds'
  ])->fly();
```




