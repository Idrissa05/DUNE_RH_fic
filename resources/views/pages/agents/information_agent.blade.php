@extends('layouts.material')

@section('content')
<div class="card">
        <div class="card-body">
            <h3 class="">Information de {{ $agent->nom . $agent->prenom }}</h3>
            <div class="row">
                <div class="col-md-5">
                    <form action="" class="mb-4">
                        <div class="form-inline">
                            <div class="form-group mr-2">
                                <label  for="start_at" class="mr-1">Période: </label>
                                <input type="text" value="" name="date" id="start_at" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-inline mt-2">
                            <div class="form-group mr-2">
                                <label  for="user_id" class="mr-3">Agent: </label>
                                <select name="user_id" id="user_id" class="form-control form-control-sm">
                                    <option value="0">Tous</option>
                                    @foreach($users as $user)
                                        <option {{ $user->id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-red float-right btn-sm">Rechercher</button>
                        </div>
                    </form>
                 <div class="card card-outline-danger px-1 pt-3">
                     <h5 class="text-center text-black-50">Ventes Directes</h5>
                     <table class="table table-sm table-bordered text-center">
                         <caption class="text-black-50"><span class="ml-4">Total brut: 566556</span></caption>
                         <thead class="bg-inverse text-white">
                         <tr>
                             <th>#</th>
                             <th>Opérateur</th>
                             <th>Montant</th>
                         </tr>
                         </thead>
                         <tbody>
                         @foreach($users as $user)
                             <tr>
                                 <td>{{ $user->id }}</td>
                                 <td>{{ $user->name }}</td>
                                 <td>66655</td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>


                   <div class="card card-outline-danger px-1">
                       <h5 class="text-center text-black-50 mt-sm-3">Ventes Revendeurs</h5>
                       <table class="table table-sm table-bordered text-center">
                           <caption class="text-black-50">
                               <span class="ml-4">Total brut: 54554</span>
                               <span class="ml-4">Total net: 5455</span>
                           </caption>
                           <thead class="bg-inverse text-white">
                           <tr>
                               <th>#</th>
                               <th>Opérateur</th>
                               <th>Montant brut</th>
                               <th>Montant net</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($users as $user)
                               <tr>
                                   <td>{{ $user->id }}</td>
                                   <td>{{ $user->name }}</td>
                                   <td>656565</td>
                                   <td>5565</td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>

                         <div class="card card-outline-danger px-1">
                             <h5 class="text-center text-black-50 mt-sm-3">Ventes Occasionnelles</h5>
                             <table class="table table-sm table-bordered text-center">
                                 <caption class="text-black-50">
                                     <span class="ml-4">Total brut: 56565</span>
                                     <span class="ml-4">Total net: 655665</span>
                                 </caption>
                                 <thead class="bg-inverse text-white">
                                 <tr>
                                     <th>#</th>
                                     <th>Opérateur</th>
                                     <th>Montant brut</th>
                                     <th>Montant net</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($users as $user)
                                     <tr>
                                         <td>{{ $user->id }}</td>
                                         <td>{{ $user->name }}</td>
                                         <td>54556</td>
                                         <td>54566</td>
                                     </tr>
                                 @endforeach
                                 </tbody>
                             </table>
                         </div>
                </div>

                <div class="col-md-7">
                    <table class="table table-sm table-bordered table-hover text-center" id="myTable">
                        <thead class="bg-inverse text-white">
                            <tr>
                                <th>#</th>
                                <th>Opérateur</th>
                                <th>Produit</th>
                                <th>Stock</th>
                                <th>Vendue</th>
                                <th>Envoyée</th>
                                <th>Restante</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row font-18 mt-4">
                <div class="col-sm-3 label p-1 label-inverse text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Total brut du jour  : </span><span class="font-bold">5665</span>
                </div>
                <div class="col-sm-3 label p-1 label-inverse text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Total net du jour : </span><span class="font-bold">655656</span>
                </div>
                <div class="col-sm-3 label p-1 label-inverse text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Montant à verser  : </span><span class="font-bold">556556</span>
                </div>
            </div>
            <div class="row font-18 mt-2">
                <div class="col-sm-3 label p-1 label-light-primary text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Ventes à crédit : </span><span class="font-bold">55565</span>
                </div>
                <div class="col-sm-3 label p-1 label-light-warning text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Dépenses : </span><span class="font-bold">656566</span>
                </div>
                <div class="col-sm-3 label p-1 label-light-danger text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Montant versé  : </span><span class="font-bold">54556</span>
                </div>
            </div>
            <div class="row font-18 mt-2">
                <div class="col-sm-3 label p-1 label-light-inverse text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Total Cash  : </span><span class="font-bold">555565</span>
                </div>
                <div class="col-sm-3 label p-1 label-light-megna text-justify text-sm-center offset-sm-1">
                    <span class="font-normal">Montant Regularisé  : </span><span class="font-bold">565656</span>
                </div>
            </div>
        </div>
    </div>
@endsection