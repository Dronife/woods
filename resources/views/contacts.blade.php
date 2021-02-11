@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">

                <div class="d-flex  card-header">
                    Contacts
                </div>

                <div class="card-body">
                    <div class="row justify-content-center pb-5">
                        <h2>Your preliminary price is <label class="text-success">{{ app('request')->input('lastPrice') }}</label>$</h2>

                    </div>
                    <table class="table pt-5">
                        <thead>
                            <tr>
                                <h5>Contact specialist</h5>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Head Specialist</b></td>
                                <td>John Simpsons
                                
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Phone</b></td>
                                            <td>+370669810</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>J.Simpson@gmail.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>

                            </tr>
                            <tr>
                                <td><b>Sell Manager</b></td>
                                <td>Greta Marlin
                                
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Phone</b></td>
                                            <td>+3704206982</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>gretamarlin@gmail.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection