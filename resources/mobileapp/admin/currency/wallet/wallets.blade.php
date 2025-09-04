@extends('admin.layouts.app')
@section('panel')

    <div class="row">

        <div class="table-responsive border rounded">
            <table class="table align-middle text-nowrap mb-0">
              <thead>
                <tr> 
                  <th scope="col">Coin</th>
                  <th scope="col">Date</th>
                  <th scope="col">Address</th>
                  <th scope="col">Balance</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($wallets as $data)
                <tr>
                   
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{ url('/') }}/assets/images/coins/{{@$data->coin->image}}" class="rounded-circle" alt="..." width="56"
                        height="56">
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-0 fs-4">{{@$data->coin->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0"> {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}</p>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                       <p class="mb-0 ms-2">{{$data->address}}</p> 
                    </div>
                    @if($data->status == 1)
                       <label class="mb-0 badge bg-success">Active</label>
                       @else
                       <label class="mb-0 badge bg-danger">Inactive</label>
                    @endif
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">${{number_format($data->usd,2)}}</h6>
                    <p class="mb-0">{{$data->balance}}{{@$data->coin->symbol}}</p>
                  </td>
                  <td>
                    @can(['admin.crypto.viewwalletd*','admin.crypto.deactivatewallet*','admin.crypto.activatewallet*'])
                    <div class="btn-group mb-2">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          @can(['admin.crypto.viewwalletd*'])
                          <li><a class="dropdown-item" href="{{route('admin.crypto.viewwalletd',$data->address)}}">Transactions</a></li>
                          @endcan
                          @if($data->status == 1)
                          @can(['admin.crypto.deactivatewallet*'])
                          <li>
                            <a class="dropdown-item" href="{{route('admin.crypto.deactivatewallet',$data->address)}}">Deactivate</a>
                          </li>
                          @endcan
                          @else
                          @can(['admin.crypto.activatewallet*'])
                          <li>
                            <a class="dropdown-item" href="{{route('admin.crypto.activatewallet',$data->address)}}">Activate</a>
                          </li>
                          @endcan
                          @endif
                        </ul>
                      </div>
                      @endcan
                  </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
    </div>
</div>

@endsection



@push('script')

@endpush
