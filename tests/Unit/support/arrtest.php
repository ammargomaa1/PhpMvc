<?php

require_once './src/Support/helpers.php';

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Arr;

class arrtest extends TestCase
{
    public function test_it_pushes_an_item_to_an_array()
    {
        $items = [
            'Ammar'=>['age'=>24],
            'php'=>['version'=>8],
            'js'=>['version'=>'latest'],
            'boxout'=>['add'=>'shehabya']
        ];

        $extracted = Arr::only($items, ['Ammar','php']);

        $this->assertSame([
            'Ammar'=>['age'=>24],
            'php'=>['version'=>8]
        ], $extracted);
    }
 
    public function test_it_checks_for_accessability_in_array_items()
    {
        $data = [
            'username' => 'ammargomaa',
            'emails'=>[
                'primary'=>'ammargomaa1@gmail.com',
                'secondary'=>'mohamed.1232009@gmail.com'
            ]
            ];

        $this->assertFalse(Arr::setAccessability($data, 'username'));
    }

    public function test_it_checks_for_data_existance()
    {
        $data = [
            'username' => 'ammargomaa',
            'emails'=>[
                'primary'=>'ammargomaa1@gmail.com',
                'secondary'=>'mohamed.1232009@gmail.com'
            ]
            ];

        $this->assertFalse(Arr::exists($data, 'password'));
        $this->assertTrue(Arr::exists($data, 'username'));
    }

    /*public function
    test_it_checks_for_data_existance_for_instance_of_array_access()
    {

    }*/

    public function test_it_modifies_an_item_by_its_key_or_index()
    {
        $data = [
            'username' => 'ammargomaa',
            'emails'=>[
                'primary'=>'ammargomaa1@gmail.com',
                'secondary'=>'mohamed.1232009@gmail.com'
            ]
            ];

        Arr::set($data, 0, 'ahmed');
        $this->assertEquals('ahmed', $data[0]);

        Arr::set($data, 'emails.primary', 'anothermail@ex.com');

        $this->assertEquals('anothermail@ex.com', $data['emails']['primary']);
    }

    public function test_it_sets_whole_array_to_value_if_a_key_is_not_given()
    {
        $arr = [1,2,3,4];

        Arr::set($arr, null, 'ahmed');

        $this->assertEquals($arr, 'ahmed');
    }


    public function test_it_adds_item_to_an_array()
    {
        $names = ['ahmed','mohamed','mahmoud'];

        $newArray = Arr::add($names, count($names), 'ismael');

        $this->assertEquals('ismael', end($newArray));
        
    }

    public function test_it_does_not_modify_items_when_adding_new_ones()
    {
        $array = [
            'username' => 'ammar',
            'password' => 'nada'
        ];

        $newArray = Arr::add($array, 'username', 'AG');

        $this->assertEquals('ammar', $newArray['username']);
    }

    public function test_it_gets_the_first_item_from_an_array()
    {
        $array = [
            'first'=>1,
            'second'=>2
        ];

        $this->assertEquals(1, Arr::first($array));
    }

    public function test_it_gets_the_last_item_from_an_array()
    {
        $array = [
            'first'=>1,
            'second'=>2
        ];

        $this->assertEquals(2, Arr::last($array));
    }

    public function test_it_returns_specific_default_value_if_the_first_item_does_not_exist()
    {
        $array = [];

        $this->assertEquals('nothin', Arr::first($array, default: 'nothin'));
    }

    public function test_it_applies_callback_before_returning_the_first_item()
    {
        $array = [1,2,3,4,5];
        
        $this->assertEquals(10, Arr::first($array, fn ($x) =>$x*10));
    }

    public function test_it_gets_an_item_using_dot_separated_string_of_keys()
    {
        $config = [
            'db' =>[
                'hosts'=>[
                    'primary' => '127.0.0.1',
                    'secondary'=>'localhost'
                ]
            ]
                ];
        $this->assertEquals('localhost', Arr::get($config, 'db.hosts.secondary'));
    }

    public function test_it_gets_an_item_using_its_key_or_index()
    {
        $numbers = [1,2,'third'=>3,4,5];

        $this->assertEquals(2,Arr::get($numbers,1));
        $this->assertEquals(3,Arr::get($numbers,'third'));
    }

    public function test_it_requires_keys_to_check_if_an_array_has_them()
    {
        $items = ['first'=>1,'second'=>2];

        $this->assertFalse(Arr::has($items,''));
        $this->assertFalse(Arr::has($items,null));
        $this->assertFalse(Arr::has($items,[]));
    }

    public function test_it_returns_false_if_given_keys_do_not_exist_in_an_array()
    {
        $items = ['first'=>1,'second'=>2];

        $this->assertFalse(Arr::has($items,'third'));
        $this->assertFalse(Arr::has($items,['third','fourth']));
    }

    public function test_it_returns_true_if_items_exist_within_an_array()
    {
        $items = [
            'first'=>1,
            'second'=>2,
            3=>'third',
            4=>'fourth'
        ];

        $this->assertTrue(Arr::has($items,'first'));
        $this->assertTrue(Arr::has($items,['first','second']));
        $this->assertTrue(Arr::has($items,[3,4]));
        $this->assertTrue(Arr::has($items,['first','second',3,4]));
    }

    public function test_it_uses_dot_as_a_delimiter_for_items_existence()
    {
        $categories = [
            'technology'=>[
                'laptops'=>[
                    'dell'=>[
                        'gtx'=>[
                            'dell-g5',
                            'dell-g3'
                        ]
                    ]
                ]
            ]
                        ];

        $this->assertTrue(Arr::has($categories,'technology.laptops'));
        $this->assertTrue(Arr::has($categories,'technology.laptops.dell'));
        $this->assertTrue(Arr::has($categories,'technology.laptops.dell.gtx'));
        $this->assertTrue(Arr::has($categories,'technology.laptops.dell.gtx.0'));

    }
    public function test_it_removes_an_item_from_an_array()
    {
        $users = [
            'AmmarJoma' => [
                'username'=>'ammarGomaa',
                'email' => 'ammarGomaa1@gmail.com'
            ],
            'AhmedOsama'=>[
                'username'=>'ahmedosama',
                'email'=>'ahmedosam@eas.co'
            ]
            ];

            $this->assertArrayHasKey('AhmedOsama',$users);
            Arr::forget($users,'AhmedOsama');
            $this->assertArrayNotHasKey('AhmedOsama',$users);
    }

    public function test_it_removes_multiple_items_from_an_array()
    {
        $ranks = [
            'first'=>118,
            'second'=>110,
            'third'=>107,
            'fourth'=>99,
            'fifth'=>85,
            'sixth'=>79,
            'seventh'=>78,
            'eighth'=>75
        ];

        $excludedkeys = ['sixth','seventh','eighth'];
        foreach ($excludedkeys as $key ) {
            $this->assertArrayHasKey($key,$ranks);
        }

        Arr::forget($ranks,$excludedkeys);

        foreach ($excludedkeys as $key ) {
            $this->assertArrayNotHasKey($key,$ranks);
        }

    }
}
