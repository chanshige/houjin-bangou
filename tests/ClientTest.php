<?php

namespace Chanshige\HoujinBangou;

use Chanshige\HoujinBangou\Condition\Criteria\CorporateName;
use Chanshige\HoujinBangou\Contracts\ResponseInterface;
use GuzzleHttp\ClientInterface;
use Koriym\HttpConstants\StatusCode;
use PHPUnit\Framework\TestCase;
use Mockery as M;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ClientTest extends TestCase
{
    public function testInvoke()
    {
        $response = M::mock(PsrResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn(StatusCode::OK);
        $response->shouldReceive('getHeaders')->andReturn([]);
        $response->shouldReceive('getBody')->andReturn($this->xml());

        $client = M::mock(ClientInterface::class);
        $client->shouldReceive('request')->once()->andReturnUsing(function ($method, $uri) use ($response) {
            $this->assertEquals('GET', $method);
            $this->assertEquals('https://api.houjin-bangou.nta.go.jp/4/name?id=application_id&name=%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E6%B3%95%E4%BA%BA%E5%90%8D&type=12&history=0', $uri);

            return $response;
        });

        $houjin = new Client($client, 'application_id');
        $response = $houjin((new CorporateName())->name('株式会社法人名'));

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(StatusCode::OK, $response->statusCode());
        $this->assertEquals([], $response->headers());
        $this->assertEquals($this->xml(), $response->body());
        $this->assertEquals($this->json(), $response->toJson());
        $this->assertEquals($this->array(), $response->toArray());
    }

    private function xml()
    {
        return <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<corporations>
    <lastUpdateDate>2020-08-20</lastUpdateDate>
    <count>1</count>
    <divideNumber>1</divideNumber>
    <divideSize>1</divideSize>
    <corporation>
        <sequenceNumber>1</sequenceNumber>
        <corporateNumber>1290001089235</corporateNumber>
        <process>01</process>
        <correct>0</correct>
        <updateDate>2020-06-24</updateDate>
        <changeDate>2020-06-24</changeDate>
        <name>株式会社リクメディア</name>
        <nameImageId/>
        <kind>301</kind>
        <prefectureName>福岡県</prefectureName>
        <cityName>福岡市中央区</cityName>
        <streetNumber>天神１</streetNumber>
        <addressImageId/>
        <prefectureCode>40</prefectureCode>
        <cityCode>133</cityCode>
        <postCode>8100001</postCode>
        <addressOutside/>
        <addressOutsideImageId/>
        <closeDate/>
        <closeCause/>
        <successorCorporateNumber/>
        <changeCause/>
        <assignmentDate>2020-06-24</assignmentDate>
        <latest>1</latest>
        <enName/>
        <enPrefectureName/>
        <enCityName/>
        <enAddressOutside/>
        <furigana>リクメディア</furigana>
        <hihyoji>0</hihyoji>
    </corporation>
</corporations>
EOS;
    }

    private function json()
    {
        return '{"corporations":{"lastUpdateDate":"2020-08-20","count":"1","divideNumber":"1","divideSize":"1","corporation":{"sequenceNumber":"1","corporateNumber":"1290001089235","process":"01","correct":"0","updateDate":"2020-06-24","changeDate":"2020-06-24","name":"\u682a\u5f0f\u4f1a\u793e\u30ea\u30af\u30e1\u30c7\u30a3\u30a2","nameImageId":"","kind":"301","prefectureName":"\u798f\u5ca1\u770c","cityName":"\u798f\u5ca1\u5e02\u4e2d\u592e\u533a","streetNumber":"\u5929\u795e\uff11","addressImageId":"","prefectureCode":"40","cityCode":"133","postCode":"8100001","addressOutside":"","addressOutsideImageId":"","closeDate":"","closeCause":"","successorCorporateNumber":"","changeCause":"","assignmentDate":"2020-06-24","latest":"1","enName":"","enPrefectureName":"","enCityName":"","enAddressOutside":"","furigana":"\u30ea\u30af\u30e1\u30c7\u30a3\u30a2","hihyoji":"0"}}}';
    }

    private function array()
    {
        return [
            "corporations" => [
                "lastUpdateDate" => "2020-08-20",
                "count" => "1",
                "divideNumber" => "1",
                "divideSize" => "1",
                "corporation" => [
                    "sequenceNumber" => "1",
                    "corporateNumber" => "1290001089235",
                    "process" => "01",
                    "correct" => "0",
                    "updateDate" => "2020-06-24",
                    "changeDate" => "2020-06-24",
                    "name" => "株式会社リクメディア",
                    "nameImageId" => "",
                    "kind" => "301",
                    "prefectureName" => "福岡県",
                    "cityName" => "福岡市中央区",
                    "streetNumber" => "天神１",
                    "addressImageId" => "",
                    "prefectureCode" => "40",
                    "cityCode" => "133",
                    "postCode" => "8100001",
                    "addressOutside" => "",
                    "addressOutsideImageId" => "",
                    "closeDate" => "",
                    "closeCause" => "",
                    "successorCorporateNumber" => "",
                    "changeCause" => "",
                    "assignmentDate" => "2020-06-24",
                    "latest" => "1",
                    "enName" => "",
                    "enPrefectureName" => "",
                    "enCityName" => "",
                    "enAddressOutside" => "",
                    "furigana" => "リクメディア",
                    "hihyoji" => "0",
                ],
            ],
        ];
    }
}
