<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_can_create_user() //FONCTIONNE, MAIS CHANGER LES DONNEES A CHAQUE FOIS 
    // {
    //     $formData =[
    //         'name'=> 'olivier',
    //         'email'=> 'olivier@olive.olive',
    //         'password'=> 'tata'
    //     ];
    //     $retour = $this->post(route('user.store'), $formData);
    //     $retour->assertStatus(200);

    // }

        public function test_can_get_all_user(){ //FONCTIONNE

            $formData = [
                'name',
                'email',
                'password'
            ];

            $return = $this->get(route('user.index'), $formData);
            $return->assertJsonCount(10);

        }

        public function test_can_show_one_user(){    //FONCTIONNE
           
            $formData = [
                
                'name',
                'email',
                'password'
            ];

            $return = $this->get(route('user.show',3), $formData);
            $return->assertStatus(200);
        }

        // public function test_can_delete_user() {  //FONCTIONNE
           
        //     $formData = [
                
        //         'name',
        //         'email',
        //         'password'
        //     ];

        //     $return = $this->delete(route('user.destroy',4), $formData);
        //     $return->assertStatus(200);
        // }

        // public function test_can_update_user() {  //FONCTIONNE
           
        //     $formData = [
                
        //         'name',
        //         'email',
        //         'password'
        //     ];

        //     $return = $this->put(route('user.update',5), $formData);
        //     $return->assertStatus(200);
        // }

        public function test_can_update_user() {  // EN TEST
           
            $formData = [
                
                'name' => 'nouveau nom',
                'email'=> 'nouveau test',
                
            ];

            $return = $this->put(route('user.update',1), $formData);
            $return->assertStatus(200);
            $return->assertJson(['user' => $formData]);
        }

}
