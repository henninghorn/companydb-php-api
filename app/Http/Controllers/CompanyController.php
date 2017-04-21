<?php


namespace App\Http\Controllers;

use App\Company;
use App\Person;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index() {
        return [
            'data' => Company::orderBy('id', 'asc')->get()
        ];
    }

    public function show($id) {
        $company = Company::with('people')->findOrFail($id);

        $people = $company->people->map(function ($person) {
            return [
                'id'   => $person->id,
                'name' => $person->name,
                'role' => $person->pivot->role
            ];
        });

        return [
            'id'      => $company->id,
            'name'    => $company->name,
            'address' => $company->address,
            'city'    => $company->city,
            'country' => $company->country,
            'email'   => $company->email,
            'phone'   => $company->phone,
            'people'  => $people
        ];
    }

    public function store() {
        $this->validate($this->request, Company::$createRules);

        $company = new Company;

        $company->fill($this->request->all());
        $company->saveOrFail();

        return response($company, Response::HTTP_CREATED);
    }

    public function update($id) {
        $this->validate($this->request, Company::$updateRules);

        $company = Company::findOrFail($id);
        $company->update($this->request->intersect([
            'name',
            'address',
            'city',
            'country',
            'email',
            'phone'
        ]));

        return response($company);
    }

    public function addNewPerson($company_id) {
        $this->validate($this->request,
            array_merge(Person::$createRules, [
                    'role' => 'required|in:founder,owner'
                ]
            )
        );

        $company = Company::findOrFail($company_id);
        $person = new Person();
        $person->fill($this->request->all());
        $person->saveOrFail();

        $role = $this->request->get('role');

        $company->people()->save($person, ['role' => $role]);

        $data = [
            'data' => [
                'id' => $person->id,
                'name' => $person->name,
                'role' => $role
            ]
        ];

        return response($data, Response::HTTP_CREATED);
    }
}