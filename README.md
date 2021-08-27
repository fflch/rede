Exemplo de requisição post com shell:

    curl --include --header "Authorization: 123"      \
        --data '{                                     \
                  "hostname": "008.054517",           \
                  "ip": "200.0.1.4"                   \
                 }'                                   \
        http://127.0.0.1:8000/api/snapshot

Exemplo de requisição post com python:

    import requests
    import json

    url = 'http://127.0.0.1:8000/api/snapshot'
    body = {'hostname': '008.054517','ip': '200.0.1.4'}
    headers = {'Authorization': '1234'}

    r = requests.post(url, data=json.dumps(body), headers=headers)
    print(r)

Exemplo com PHP:

use Symfony\Component\HttpClient\HttpClient;
$client = HttpClient::create();

$response = $client->request('POST', 'http://127.0.0.1:8000/api/snapshot', [
    'body' => ['hostname' => '008.054517','ip' => '200.0.1.4'],
    'headers' => ['Content-Type' => 'text/plain'],
]);


$statusCode = $response->getStatusCode();
// $statusCode = 200
$contentType = $response->getHeaders()['content-type'][0];
// $contentType = 'application/json'
$content = $response->getContent();
// $content = '{"id":521583, "name":"symfony-docs", ...}'
$content = $response->toArray();
// $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
