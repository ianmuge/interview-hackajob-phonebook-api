<?php


use Laravel\Lumen\Testing\DatabaseTransactions;


class ContactsTest extends TestCase
{
    use DatabaseTransactions;
    private $active_token;
    protected function setUp():void
    {
        parent::setUp();
        $this->active_token=$this->get_token();
    }
    public function get_token(){
        $response=$this->post( '/auth/login', [
            'email'    => 'user@example.com',
            'password' => 'AGoodPassword'
        ]);
        $response=json_decode($response->response->getContent());
        return $response->token;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_browse()
    {
        $this->get('/contact/',['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
        $this->assertStringContainsString("data",$this->response->getContent());

    }
    public function test_valid_show()
    {
        $contact=\App\Contact::all()->first();
        $this->get('/contact/'.$contact->id,['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
        $this->assertStringContainsString("contact",$this->response->getContent());

    }
    public function test_invalid_show()
    {
        $contact=\App\Contact::all()->last();
        $this->get('/contact/'.($contact->id+1),['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(404);

    }
    public function test_invalid_link()
    {
        $this->get('/contact/dfd',['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(404);
    }
    public function test_valid_store()
    {
        $contact = [
            'name'=>"Foo bar",
            'phonenumber'=>"+4545454545",
            'address'=>"A long Address, M99 9YZ"
        ];
        $this->post('/contact/',$contact,['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
        $this->assertStringContainsString("contact",$this->response->getContent());
        $this->seeInDatabase('contacts', $contact);

    }
    public function test_invalid_store()
    {
        $this->post('/contact/',[],['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(422);
        $this->assertStringContainsString("required",$this->response->getContent());

    }
    public function test_valid_update()
    {
        $contact=\App\Contact::all()->random();
        $contact_new =  [
            'name'=>"Foo Update",
            'phonenumber'=>"+89898989",
            'address'=>"An update Address, M00 0AB"
        ];
        $this->patch('/contact/'.$contact->id,$contact_new,['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
        $this->assertStringContainsString("contact",$this->response->getContent());
        $this->seeInDatabase('contacts', $contact_new);

    }
    public function test_invalid_update()
    {
        $contact=\App\Contact::all()->random();
        $this->patch('/contact/'.$contact->id,[],['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(422);
        $this->assertStringContainsString("required",$this->response->getContent());

    }
    public function test_valid_delete()
    {
        $contact=\App\Contact::all()->random();
        $this->delete('/contact/'.$contact->id,['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
        $this->assertStringContainsString("contact",$this->response->getContent());

    }
    public function test_invalid_delete()
    {
        $contact=\App\Contact::all()->last();
        $this->delete('/contact/'.($contact->id+1),['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(404);

    }
    public function test_search()
    {
        $this->get('/contact/search/',['Authorization' => 'Bearer '.$this->active_token]);
        $this->assertResponseStatus(200);
    }

    protected function tearDown():void
    {
        parent::tearDown();
        $this->active_token = null;
    }
}
