<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("company.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $logo = $request->file('logo');
        $logo_name = "";
        if ($logo) {
            // Rename the file
            $originalName = $logo->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $logo->getClientOriginalExtension();
            $logo_name = time().'.'.$extension;

            $path = $logo->storeAs('public', $logo_name);
        }

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $logo_name,
            'website' => $request->website,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $employees = $company->employees()->paginate(10);
        return view("company.show",compact('company','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view("company.edit",compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $logo = $request->file('logo');
        $logo_name = "";
        if ($logo) {
            // Rename the file
            $originalName = $logo->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $logo->getClientOriginalExtension();
            $logo_name = time().'.'.$extension;

            $path = $logo->storeAs('public', $logo_name);
        }
        
        
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $logo_name;
        $company-> website = $request->website;
        $company->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            $company->employees()->delete();
            $company->deleteOrFail();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                $e->getMessage(),
            ]);
        }
    }
}
