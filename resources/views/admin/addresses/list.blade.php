@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($addresses)
            <div class="box">
                <div class="box-body">
                    <h2>Alamat</h2>
                    @include('layouts.search', ['route' => route('admin.addresses.index')])
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-2">Customer</td>
                                <td class="col-md-1">Alias</td>
                                <td class="col-md-2">Alamat 1</td>
                                <!--<td class="col-md-1">Negara</td>-->
                                <td class="col-md-2">Propinsi</td>
                                <td class="col-md-1">Kota</td>
                                <td class="col-md-1">Kode Pos</td>
                                <td class="col-md-1">Status</td>
                                <td class="col-md-3">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($addresses as $address)
                            <tr>
                                <td>{{ $address->customer }}</td>
                                <td><a href="{{ route('admin.customers.show', [$address->customer_id]) }}">{{ $address->alias }}</a></td>
                                <td>{{ $address->address_1 }}</td>
                                <!--<td>{{ $address->country }}</td>-->
                                <td>{{ $address->province }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->state_code }}</td>
                                <td>@include('layouts.status', ['status' => $address->status])</td>
                                <td>
                                    <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.addresses.edit', $address->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($addresses instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">{{ $addresses->links() }}</div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @else
            <div class="box">
                <div class="box-body"><p class="alert alert-warning">Alamat tidak ditemukan</p></div>
            </div>
        @endif
    </section>
    <!-- /.content -->
@endsection