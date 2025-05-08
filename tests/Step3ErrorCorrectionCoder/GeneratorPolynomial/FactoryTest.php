<?php

namespace Tests\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256Operations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256Polynomial;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256BinomialGenerator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256PolynomialOperations;

class FactoryTest extends LoggerTestCase
{
    private Factory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = new Factory(
            new Gf256BinomialGenerator(Gf256::getInstance()),
            new Gf256PolynomialOperations(Gf256Operations::getInstance()),
            $this->logger
        );
    }

    /**
     * @dataProvider provideDataToTestCreate
     */
    public function testCreate(int $numECCodewords, string $expectedPolynomial): void
    {
        $actualPolynomial = new Gf256Polynomial(
            Gf256::getInstance(),
            $this->factory->create($numECCodewords)
        );
        $this->assertEquals($expectedPolynomial, "$actualPolynomial");
    }

    public static function provideDataToTestCreate(): \Generator
    {
        yield [7, 'a^0.x^7 + a^87.x^6 + a^229.x^5 + a^146.x^4 + a^149.x^3 + a^238.x^2 + a^102.x^1 + a^21.x^0'];
        yield [10, 'a^0.x^10 + a^251.x^9 + a^67.x^8 + a^46.x^7 + a^61.x^6 + a^118.x^5 + a^70.x^4 + a^64.x^3 + a^94.x^2 + a^32.x^1 + a^45.x^0'];
        yield [13, 'a^0.x^13 + a^74.x^12 + a^152.x^11 + a^176.x^10 + a^100.x^9 + a^86.x^8 + a^100.x^7 + a^106.x^6 + a^104.x^5 + a^130.x^4 + a^218.x^3 + a^206.x^2 + a^140.x^1 + a^78.x^0'];
        yield [15, 'a^0.x^15 + a^8.x^14 + a^183.x^13 + a^61.x^12 + a^91.x^11 + a^202.x^10 + a^37.x^9 + a^51.x^8 + a^58.x^7 + a^58.x^6 + a^237.x^5 + a^140.x^4 + a^124.x^3 + a^5.x^2 + a^99.x^1 + a^105.x^0'];
        yield [16, 'a^0.x^16 + a^120.x^15 + a^104.x^14 + a^107.x^13 + a^109.x^12 + a^102.x^11 + a^161.x^10 + a^76.x^9 + a^3.x^8 + a^91.x^7 + a^191.x^6 + a^147.x^5 + a^169.x^4 + a^182.x^3 + a^194.x^2 + a^225.x^1 + a^120.x^0'];
        yield [17, 'a^0.x^17 + a^43.x^16 + a^139.x^15 + a^206.x^14 + a^78.x^13 + a^43.x^12 + a^239.x^11 + a^123.x^10 + a^206.x^9 + a^214.x^8 + a^147.x^7 + a^24.x^6 + a^99.x^5 + a^150.x^4 + a^39.x^3 + a^243.x^2 + a^163.x^1 + a^136.x^0'];
        yield [18, 'a^0.x^18 + a^215.x^17 + a^234.x^16 + a^158.x^15 + a^94.x^14 + a^184.x^13 + a^97.x^12 + a^118.x^11 + a^170.x^10 + a^79.x^9 + a^187.x^8 + a^152.x^7 + a^148.x^6 + a^252.x^5 + a^179.x^4 + a^5.x^3 + a^98.x^2 + a^96.x^1 + a^153.x^0'];
        yield [20, 'a^0.x^20 + a^17.x^19 + a^60.x^18 + a^79.x^17 + a^50.x^16 + a^61.x^15 + a^163.x^14 + a^26.x^13 + a^187.x^12 + a^202.x^11 + a^180.x^10 + a^221.x^9 + a^225.x^8 + a^83.x^7 + a^239.x^6 + a^156.x^5 + a^164.x^4 + a^212.x^3 + a^212.x^2 + a^188.x^1 + a^190.x^0'];
        yield [22, 'a^0.x^22 + a^210.x^21 + a^171.x^20 + a^247.x^19 + a^242.x^18 + a^93.x^17 + a^230.x^16 + a^14.x^15 + a^109.x^14 + a^221.x^13 + a^53.x^12 + a^200.x^11 + a^74.x^10 + a^8.x^9 + a^172.x^8 + a^98.x^7 + a^80.x^6 + a^219.x^5 + a^134.x^4 + a^160.x^3 + a^105.x^2 + a^165.x^1 + a^231.x^0'];
        yield [24, 'a^0.x^24 + a^229.x^23 + a^121.x^22 + a^135.x^21 + a^48.x^20 + a^211.x^19 + a^117.x^18 + a^251.x^17 + a^126.x^16 + a^159.x^15 + a^180.x^14 + a^169.x^13 + a^152.x^12 + a^192.x^11 + a^226.x^10 + a^228.x^9 + a^218.x^8 + a^111.x^7 + a^0.x^6 + a^117.x^5 + a^232.x^4 + a^87.x^3 + a^96.x^2 + a^227.x^1 + a^21.x^0'];
        yield [26, 'a^0.x^26 + a^173.x^25 + a^125.x^24 + a^158.x^23 + a^2.x^22 + a^103.x^21 + a^182.x^20 + a^118.x^19 + a^17.x^18 + a^145.x^17 + a^201.x^16 + a^111.x^15 + a^28.x^14 + a^165.x^13 + a^53.x^12 + a^161.x^11 + a^21.x^10 + a^245.x^9 + a^142.x^8 + a^13.x^7 + a^102.x^6 + a^48.x^5 + a^227.x^4 + a^153.x^3 + a^145.x^2 + a^218.x^1 + a^70.x^0'];
        yield [28, 'a^0.x^28 + a^168.x^27 + a^223.x^26 + a^200.x^25 + a^104.x^24 + a^224.x^23 + a^234.x^22 + a^108.x^21 + a^180.x^20 + a^110.x^19 + a^190.x^18 + a^195.x^17 + a^147.x^16 + a^205.x^15 + a^27.x^14 + a^232.x^13 + a^201.x^12 + a^21.x^11 + a^43.x^10 + a^245.x^9 + a^87.x^8 + a^42.x^7 + a^195.x^6 + a^212.x^5 + a^119.x^4 + a^242.x^3 + a^37.x^2 + a^9.x^1 + a^123.x^0'];
        yield [30, 'a^0.x^30 + a^41.x^29 + a^173.x^28 + a^145.x^27 + a^152.x^26 + a^216.x^25 + a^31.x^24 + a^179.x^23 + a^182.x^22 + a^50.x^21 + a^48.x^20 + a^110.x^19 + a^86.x^18 + a^239.x^17 + a^96.x^16 + a^222.x^15 + a^125.x^14 + a^42.x^13 + a^173.x^12 + a^226.x^11 + a^193.x^10 + a^224.x^9 + a^130.x^8 + a^156.x^7 + a^37.x^6 + a^251.x^5 + a^216.x^4 + a^238.x^3 + a^40.x^2 + a^192.x^1 + a^180.x^0'];
        yield [32, 'a^0.x^32 + a^10.x^31 + a^6.x^30 + a^106.x^29 + a^190.x^28 + a^249.x^27 + a^167.x^26 + a^4.x^25 + a^67.x^24 + a^209.x^23 + a^138.x^22 + a^138.x^21 + a^32.x^20 + a^242.x^19 + a^123.x^18 + a^89.x^17 + a^27.x^16 + a^120.x^15 + a^185.x^14 + a^80.x^13 + a^156.x^12 + a^38.x^11 + a^69.x^10 + a^171.x^9 + a^60.x^8 + a^28.x^7 + a^222.x^6 + a^80.x^5 + a^52.x^4 + a^254.x^3 + a^185.x^2 + a^220.x^1 + a^241.x^0'];
        yield [34, 'a^0.x^34 + a^111.x^33 + a^77.x^32 + a^146.x^31 + a^94.x^30 + a^26.x^29 + a^21.x^28 + a^108.x^27 + a^19.x^26 + a^105.x^25 + a^94.x^24 + a^113.x^23 + a^193.x^22 + a^86.x^21 + a^140.x^20 + a^163.x^19 + a^125.x^18 + a^58.x^17 + a^158.x^16 + a^229.x^15 + a^239.x^14 + a^218.x^13 + a^103.x^12 + a^56.x^11 + a^70.x^10 + a^114.x^9 + a^61.x^8 + a^183.x^7 + a^129.x^6 + a^167.x^5 + a^13.x^4 + a^98.x^3 + a^62.x^2 + a^129.x^1 + a^51.x^0'];
        yield [36, 'a^0.x^36 + a^200.x^35 + a^183.x^34 + a^98.x^33 + a^16.x^32 + a^172.x^31 + a^31.x^30 + a^246.x^29 + a^234.x^28 + a^60.x^27 + a^152.x^26 + a^115.x^25 + a^0.x^24 + a^167.x^23 + a^152.x^22 + a^113.x^21 + a^248.x^20 + a^238.x^19 + a^107.x^18 + a^18.x^17 + a^63.x^16 + a^218.x^15 + a^37.x^14 + a^87.x^13 + a^210.x^12 + a^105.x^11 + a^177.x^10 + a^120.x^9 + a^74.x^8 + a^121.x^7 + a^196.x^6 + a^117.x^5 + a^251.x^4 + a^113.x^3 + a^233.x^2 + a^30.x^1 + a^120.x^0'];
        yield [40, 'a^0.x^40 + a^59.x^39 + a^116.x^38 + a^79.x^37 + a^161.x^36 + a^252.x^35 + a^98.x^34 + a^128.x^33 + a^205.x^32 + a^128.x^31 + a^161.x^30 + a^247.x^29 + a^57.x^28 + a^163.x^27 + a^56.x^26 + a^235.x^25 + a^106.x^24 + a^53.x^23 + a^26.x^22 + a^187.x^21 + a^174.x^20 + a^226.x^19 + a^104.x^18 + a^170.x^17 + a^7.x^16 + a^175.x^15 + a^35.x^14 + a^181.x^13 + a^114.x^12 + a^88.x^11 + a^41.x^10 + a^47.x^9 + a^163.x^8 + a^125.x^7 + a^134.x^6 + a^72.x^5 + a^20.x^4 + a^232.x^3 + a^53.x^2 + a^35.x^1 + a^15.x^0'];
        yield [68, 'a^0.x^68 + a^247.x^67 + a^159.x^66 + a^223.x^65 + a^33.x^64 + a^224.x^63 + a^93.x^62 + a^77.x^61 + a^70.x^60 + a^90.x^59 + a^160.x^58 + a^32.x^57 + a^254.x^56 + a^43.x^55 + a^150.x^54 + a^84.x^53 + a^101.x^52 + a^190.x^51 + a^205.x^50 + a^133.x^49 + a^52.x^48 + a^60.x^47 + a^202.x^46 + a^165.x^45 + a^220.x^44 + a^203.x^43 + a^151.x^42 + a^93.x^41 + a^84.x^40 + a^15.x^39 + a^84.x^38 + a^253.x^37 + a^173.x^36 + a^160.x^35 + a^89.x^34 + a^227.x^33 + a^52.x^32 + a^199.x^31 + a^97.x^30 + a^95.x^29 + a^231.x^28 + a^52.x^27 + a^177.x^26 + a^41.x^25 + a^125.x^24 + a^137.x^23 + a^241.x^22 + a^166.x^21 + a^225.x^20 + a^118.x^19 + a^2.x^18 + a^54.x^17 + a^32.x^16 + a^82.x^15 + a^215.x^14 + a^175.x^13 + a^198.x^12 + a^43.x^11 + a^238.x^10 + a^235.x^9 + a^27.x^8 + a^101.x^7 + a^184.x^6 + a^127.x^5 + a^3.x^4 + a^5.x^3 + a^8.x^2 + a^163.x^1 + a^238.x^0'];
    }
}
