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
        $response = $this->call('GET', '/create');
        $response->assertStatus(403);
    }

    public function test_create()
    {
        $user = $this->auth();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('GET', '/create');
        $response->assertStatus(200);
        $response->assertViewIs('contacts.create');
    }

    public function test_store_not_authenticated()
    {
        $response = $this->call('POST', '/', ['name' => 'Test']);
        $response->assertStatus(403);
    }

    public function test_store() 
    {
        $user = $this->auth();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('POST', '/', ['name' => 'Test']);
        $response->assertStatus(302);    
        $response->assertRedirect('/');
    }

    public function test_show_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('get', '/'.$contact->first()->id);
        $response->assertStatus(403);
    }

    public function test_show() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name'=>'Test 1']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('get', '/'.$contact->first()->id);
        $response->assertStatus(200);    
        $response->assertViewHas('contact');
        $contact = $response->original['contact'];
        $this->assertEquals('Test 1', $contact['name']);
    }

    public function test_destroy_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('DELETE', '/'.$contact->first()->id);
        $response->assertStatus(403);
    }


    public function test_destroy() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('DELETE', "/".$contact->first()->id);
        $response->assertStatus(302);    
        $response->assertRedirect('/');
    }

    public function test_edit_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('DELETE', '/'.$contact->first()->id.'/edit');
        $response->assertStatus(403);
    }

    public function test_edit() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create();
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('get', '/'.$contact->first()->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewIs('contact.edit');
    }

    public function test_update_not_authenticated()
    {
        $contact = Contact::factory(1)->create();
        $response = $this->call('PUT', '/'.$contact->first()->id, ['name' => 'Test']);
        $response->assertStatus(403);
    }

    public function test_update() 
    {
        $user = $this->auth();
        $contact = Contact::factory(1)->create(['name'=>'Test 1']);
        $response = $this->actingAs($user)
                         ->withSession(['user' => $user])
                         ->call('PUT', "/".$contact->first()->id, ['name' => 'Test 2']);
        $response->assertStatus(302);    
        $response->assertRedirect('/');
        $response->assertViewHas('contact');
        $contact = $response->original['contact'];
        $this->assertEquals('Test 2', $contact['name']);
    }
}