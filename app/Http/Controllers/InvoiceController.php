<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;



use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new InvoiceCollection(Invoice::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if(auth()->user()->hasInformation()){
            $request->validate([
                'pet_id' => 'required|exists:pets,id',
                'date' => [
                    'required',
                    'date',
                    'after:today',
                    function ($attribute, $value, $fail) {
                        $existingInvoice = Invoice::where('date', $value)->first();
                        if ($existingInvoice) {
                            $fail('There is already a meeting on this date.');
                        }
                    },
                ],
            ]);

            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->pet_id = $request->pet_id;
            $invoice->date = $request->date;
            $invoice->save();

            return response()->json(['message' => 'Invoice created successfully', 'invoice' => $invoice], 201);
        }else{
            return response()->json(['error' => 'User information is not set.'], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    public function invoicesByUserId()
    {
        $user = auth()->user();

        if($user){
            $invoices = Invoice::where('user_id', $user->id)->get();
            return response()->json(['invoices' => $invoices], 200);
        }else{
            return response()->json(['error' => 'User is not authenticated.'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return new InvoiceResource($invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        $invoiceId = $request->input('invoiceId');

        if($user){
            $invoice = Invoice::find($invoiceId);

            if($invoice && $invoice->user_id == $user->id){
                $invoice->delete();
                return response()->json(['message' => 'Invoice deleted successfully.'], 200);
            }else{
                return response()->json(['error' => 'Invoice not found or user is not the owner.'], 404);
            }
        }else{
            return response()->json(['error' => 'User is not authenticated.'], 401);
        }
    }

}
