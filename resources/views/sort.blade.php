@extends('layout')
@section('content')
    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th class="font-weight-bold width-stand text_small text-center">Code</th>
                <th class="font-weight-bold width-stand text_small text-center">NNMUA</th>
                <th class="font-weight-bold width-stand text_small text-center">NNBAN</th>
                <th class="font-weight-bold width-stand text_small text-center">CHÊNH LỆCH</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $results as $data)
                <tr>
                    <td  class="font-weight-bold width-stand text_small text-center" >
                    <a href="{{ route('display-vnindex',['code' => $data->code])}}">{{ $data->code }}</a>
                    </td>
                <td  class="font-weight-bold width-stand text_small text-center {{ ($data->tong_mua == 0)?'alert-success':'' }}" >{{ $data->tong_mua }}</td>
                <td  class="font-weight-bold width-stand text_small text-center {{ ($data->tong_ban == 0)?'alert-success':'' }}" >{{ $data->tong_ban }}</td>
                <td  class="font-weight-bold width-stand text_small text-center" >{{ $data->nfsdf }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
@stop