<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Coroutine;
use Hyperf\Utils\Parallel;
use Hyperf\Utils\Exception\ParallelExecutionException;

/**
 * @Controller()
 */
class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf111');
        $method = $this->request->getMethod();
        $id = \Hyperf\Utils\Coroutine::id();
        $result = [$id, $user, $method];
        co(function () {
            sleep(2);
            var_dump('sleep');
        });
        // $parallel = new Parallel(2);
        // $parallel->add(function () {
        //     var_dump('parallel_1');
        //     sleep(1);
        //     return Coroutine::id();
        // });
        // $parallel->add(function () {
        //     var_dump('parallel_2');
        //     sleep(1);
        //     return Coroutine::id();
        // });
        // var_dump('succ');
        // try{
        //     // $results 结果为 [1, 2]
        //     $result = $parallel->wait(); 
        // } catch(ParallelExecutionException $e){
        //     // $e->getResults() 获取协程中的返回值。
        //     // $e->getThrowables() 获取协程中出现的异常。
        // }
        return $this->success($result);

        // return [
        //     'method' => $method,
        //     'message' => "Hello-qqq {$user}.".\Hyperf\Utils\Coroutine::id(),
        // ];
    }

    /**
     * @RequestMapping(path="/demo1", methods="get")
     * 
     */
    public function demo(RequestInterface $request, ResponseInterface $response)
    {
        return $response->json(['abc']);
    }

/**

商户号
1630368719

序列号
31EF87F029A038D4A6411991DAA421F0145B897A

-----BEGIN CERTIFICATE REQUEST-----
MIIC2zCCAcMCAQAwgZUxCzAJBgNVBAYTAkNOMRIwEAYDVQQIDAlHdWFuZ0Rvbmcx
ETAPBgNVBAcMCFNoZW5aaGVuMRswGQYDVQQKDBLlvq7kv6HllYbmiLfns7vnu58x
LTArBgNVBAsMJOeDn+WPsOeIseWNjumrmOe6p+S4reWtpuaciemZkOWFrOWPuDET
MBEGA1UEAwwKMTYzMDM2ODcxOTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoC
ggEBALPgWcYgYcDGd5wXa4aXHAE1kwcnIhj9983FihXalPaC4lF0mdA0P6SApPk7
d0/vFCC/+wl0E+ve8ovybeQ0vroSj0Q94uuWc1OI5eQEdNBytrJb8taQERW3czj5
nhVyBtvR4mrtkInKgqh+TRhEJGzrs7J15ucMh7+8LSaRA3e5MqW2uwSd5JpxwOrh
X9vTumotgTRKbItDiZHYtkm+7D58nw/8Hj4VaXvJAs9h7e0BeVtTMj0lFFs0yXA2
LZB34lYxv6v5mP0N1+uBKUUV5LB+noBY3kWlUfo8fGPThTpOmrm1kt6GmNddC+zj
3IFs5r+6MHmm0sYBEqMnp6N6OVECAwEAAaAAMA0GCSqGSIb3DQEBCwUAA4IBAQAL
1Mq/UXZ3iaXcfztX04emyRjgbut1XCSUrHnZ9S3ZVAuik8f8+y2pnVaivHk0VeQA
+PX7naEi/WRPp9zJJcob2hbD+58mVxZaD38AKOWHpBQDIBSiScauFzN9yrL3qalC
3T7Cc7TxosKrFXsQ4w5ZyPGZHlpzKuL1y4He+eeqvZ2HRwXIkWernFASxJ2t8SiZ
DXlgpYYOmFz26AVF73gVonNBKFOYEC0u2GHlFeFnC0r/eOe5BrYLsMghTMOgcCnh
cp5GIsUsKrzjhLyzQY8xz2HLBR8WAKwSHjos7eiIebNkss0ykuSBWB0IFmFVJbv2
c3lIaHByQVMr50+2qX21
-----END CERTIFICATE REQUEST-----


-----BEGIN CERTIFICATE-----
MIID8DCCAtigAwIBAgIUMe+H8CmgONSmQRmR2qQh8BRbiXowDQYJKoZIhvcNAQEL
BQAwXjELMAkGA1UEBhMCQ04xEzARBgNVBAoTClRlbnBheS5jb20xHTAbBgNVBAsT
FFRlbnBheS5jb20gQ0EgQ2VudGVyMRswGQYDVQQDExJUZW5wYXkuY29tIFJvb3Qg
Q0EwHhcNMjIxMTI1MDE0MzM0WhcNMjcxMTI0MDE0MzM0WjCBgTETMBEGA1UEAwwK
MTYzMDM2ODcxOTEbMBkGA1UECgwS5b6u5L+h5ZWG5oi357O757ufMS0wKwYDVQQL
DCTng5/lj7DniLHljY7pq5jnuqfkuK3lrabmnInpmZDlhazlj7gxCzAJBgNVBAYM
AkNOMREwDwYDVQQHDAhTaGVuWmhlbjCCASIwDQYJKoZIhvcNAQEBBQADggEPADCC
AQoCggEBALPgWcYgYcDGd5wXa4aXHAE1kwcnIhj9983FihXalPaC4lF0mdA0P6SA
pPk7d0/vFCC/+wl0E+ve8ovybeQ0vroSj0Q94uuWc1OI5eQEdNBytrJb8taQERW3
czj5nhVyBtvR4mrtkInKgqh+TRhEJGzrs7J15ucMh7+8LSaRA3e5MqW2uwSd5Jpx
wOrhX9vTumotgTRKbItDiZHYtkm+7D58nw/8Hj4VaXvJAs9h7e0BeVtTMj0lFFs0
yXA2LZB34lYxv6v5mP0N1+uBKUUV5LB+noBY3kWlUfo8fGPThTpOmrm1kt6GmNdd
C+zj3IFs5r+6MHmm0sYBEqMnp6N6OVECAwEAAaOBgTB/MAkGA1UdEwQCMAAwCwYD
VR0PBAQDAgP4MGUGA1UdHwReMFwwWqBYoFaGVGh0dHA6Ly9ldmNhLml0cnVzLmNv
bS5jbi9wdWJsaWMvaXRydXNjcmw/Q0E9MUJENDIyMEU1MERCQzA0QjA2QUQzOTc1
NDk4NDZDMDFDM0U4RUJEMjANBgkqhkiG9w0BAQsFAAOCAQEAJBzFCAnhfQVfnxAE
so+kgbvELOlCKzpqu29YxiXfj7kjmVGsiqVkRnQqvb++rZD6HE18+5MuVywEQD4d
QOFJw6GrANi/oIcXHOBGl0sYu1rXGs7gzVWkotbYx5RStS8mr28q9Nqvy0WVU7VC
YCMuTTtAIbek1+KvNf9CyykwjVKinfxkRL2CgbfievgvM7IsrBEZI+P5s1o2wqOv
t3l84aWGEiNLiO/E/K/95+U7BCD89/u4JAQQXXpivs+3cEpbSU/RaBpSvdVHwGsI
uFqEm/Itw4rlJZEVS9xjFMMXWzWwqq2WJtmt+j3zUVVPo2tdiJkCTFRjKw+UCXy8
qbqsSw==
-----END CERTIFICATE-----


-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCz4FnGIGHAxnec
F2uGlxwBNZMHJyIY/ffNxYoV2pT2guJRdJnQND+kgKT5O3dP7xQgv/sJdBPr3vKL
8m3kNL66Eo9EPeLrlnNTiOXkBHTQcrayW/LWkBEVt3M4+Z4Vcgbb0eJq7ZCJyoKo
fk0YRCRs67OydebnDIe/vC0mkQN3uTKltrsEneSaccDq4V/b07pqLYE0SmyLQ4mR
2LZJvuw+fJ8P/B4+FWl7yQLPYe3tAXlbUzI9JRRbNMlwNi2Qd+JWMb+r+Zj9Ddfr
gSlFFeSwfp6AWN5FpVH6PHxj04U6Tpq5tZLehpjXXQvs49yBbOa/ujB5ptLGARKj
J6ejejlRAgMBAAECggEAN1RYaQBG8WRbIHF3ysOqgpi3LCkWbPeaBPqxef1tetJR
yVqDga7AsNo9ZMis77KLz3MeRg8lnZVLqE6fDOZIkLXqycP7jBoQSW6/wD66q+/N
UNnFvcg86SAv2iO2Q8R6ZZ2O9vMyVaAsRqXrEv7K8ZIjCU8JAqMxEoJQpR9QIMAb
iCx7GUaBOixoluZDsEqZhJShdLYWBjHDhqKPlMBPQ/evgmlWz+DCaNiYLKkK65WT
0dn74YRYOGWj1uKh9yalV4RF0Hr77djPkGfXSwkffzGcxUrpZYrF+MJWiYl4ncAr
mQer/eQMDpuwyYpAMXGPQiQrxC3WE9xfo2TqjqAXnQKBgQDlw+xhHLHrPAUiidEt
/vtzbNx6y+9CEB24wXUN5HF1KTs/jBcic8YC2mThDvHQVffjpIKCIg3BGSGm87eV
nZLT50cmSbWljzsNYiHZv0ZqzUWzQsoIhCPrbLPrpQLFJo0Xjo/48XwEjZxxeUzV
vy5ulSlNB0zW6b7hftkZVpG3JwKBgQDIaipQfIFveVnTvJMNCoUGWV620YKPzZr0
iAdvQj3vHGFRXgPgoxAXr3ytx+O4ZWP78tvXUGlaB6xyfw3AcuSxzew+7oQm7P6z
AKY2lVYKhpGYxipjtnSEagxj8dpPjFLFtX/g5MyVS7LR4UImPlrbBPiqjO+GRWah
woemwHyWxwKBgBGxt+d2pUD/W0ngoSpQo56s+IHAaMmGojNTOqd6Oz6RkU2AhVuS
3OHlXbVzSC4KIM/4IFDTPIntXIkV5cJw4xjMi88oCAQa9qo+L2ssbsjUzBRVBWgI
fRepRGXWTFNQd7cjtHSwbCORoEWg2MjxMysy835KHKHEWH3XHfL0lr4rAoGACCDW
KoGCNmUzkXTaefLtRj6lqsCAjRiHqldCBe8n1+TMxaIMgjXa1zsU0W+D+tyR24wU
An2OaEpbYiFpC18di2CQrlS6I2IFSnlCRIB2BuNCUHHpEjY6L4yliAAtHIDScpZT
42kkKwHw9LYwGqD4yl0/QJuKs2VpLjJXkhnIc80CgYEAy3M1Pd4mFhdkksTqRQvb
Yp0iw/rVEYv1uuGcm1gHPVLZedyOleV7vzMXQ0r5yzrJqQJlMHw9iJBXXRle+rTV
sJGus1iD5c2tTNAJz5TDDhcp6nIGU5Se1NO7WflC0yxoqy+LcnYd5/VNtwDMohbb
Y8cF3y8iVUaleJR3j8itiJ8=
-----END PRIVATE KEY-----

 */
    




}
