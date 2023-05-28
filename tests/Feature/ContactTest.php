<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    //use WithoutMiddleware;

    private function init(User $user) 
    {
        session()->put(['user' => $user]);
    }

    public function test_index()
    {
        Contact::factory(10)->create();
        $response = $this->call('GET', '/');
        $response->assertStatus(200);    
        $response->assertViewHas('contacts');
        $contacts = $response->original['contacts'];
        $this->assertEquals(10, count($contacts));       
    }

    public function test_create_not_authenticated()
    {
        $response = $this->call('GET', 'contacts/create');
        $response->assertRedirect('/login');
    }

    public function test_create()
    {
        $user = $this->auth();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('GET', 'contacts/create');
        $response->assertStatus(200);
        $response->assertViewIs('contacts.create');
    }

    public function test_store_not_authenticated()
    {
        $response = $this->call('POST', 'contacts/', ['name' => 'Test']);
        $response->assertRedirect('/login');
    }

    public function test_error_store_same_contact() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name' => 'teste1', 'contact' => '111111111', 'email' => 'ad@alfasoft.com']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('POST', 'contacts/', ['name' => 'teste2', 'contact' => '111111111', 'email' => 'ad@alfasoft.pt']);
        $response->assertSessionHasErrors(['contact']);
    }

    public function test_error_store_same_email() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name' => 'teste1', 'contact' => '111111111', 'email' => 'ad@alfasoft.com']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('POST', 'contacts/', ['name' => 'teste2', 'contact' => '111111112', 'email' => 'ad@alfasoft.com']);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_store() 
    {
        $user = $this->auth();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('POST', 'contacts/', ['name' => 'teste2', 'contact' => '111111112', 'email' => 'ad@alfasoft.com']);
        $response->assertRedirect('/contacts');
    }

    public function test_show_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('get', 'contacts/'.$contact->first()->id);
        $response->assertRedirect('/login');
    }

    public function test_show() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name'=>'Test 1']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('get', 'contacts/'.$contact->first()->id);
        $response->assertViewHas('contact');
        $contact = $response->original['contact'];
        $this->assertEquals('Test 1', $contact['name']);
    }

    public function test_destroy_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('DELETE', 'contacts/'.$contact->first()->id);
        $response->assertRedirect('/login');
    }


    public function test_destroy() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('DELETE', "contacts/".$contact->first()->id);   
        $response->assertRedirect('/contacts');
    }

    public function test_edit_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('get', 'contacts/'.$contact->first()->id.'/edit');
        $response->assertRedirect('/login');
    }

    public function test_edit() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('get', 'contacts/'.$contact->first()->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewIs('contacts.edit');
    }

    public function test_update_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('PUT', 'contacts/'.$contact->first()->id, ['name' => 'Test']);
        $response->assertRedirect('/login');
    }

    public function test_update() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name'=>'Test 1']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('PUT', "contacts/".$contact->first()->id, ['name' => 'Test 2', 'contact' => '111111112', 'email' => 'ad@alfasoft.com']);
        $response->assertRedirect('/contacts');
    }
}