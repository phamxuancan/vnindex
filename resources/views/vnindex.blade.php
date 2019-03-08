@extends('layout')
@section('content')
    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <?php $i =0;  ?>
                <th></th>
                @foreach($data_date as $date)
                    <th class="text_small text-center {{ ($i%2==0)?'odd':'even' }}" colspan="4">{{ $date }}</th>
                    <?php $i++; ?>
                @endforeach
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td  class="font-weight-bold width-stand text_small text-center" >Mã</td>
            <?php $i =0;  ?>
                @foreach($data_date as $date)
                <td class="font-weight-bold width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">TC</td>
                <td class="font-weight-bold width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">KL</td>
                <td class="font-weight-bold width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">NNMUA</td>
                <td class="font-weight-bold width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">NNBAN</td>
                <?php $i++; ?>
            @endforeach
            <th class="font-weight-bold width-stand text_small text-center"> CN </th>
            </tr>
            @foreach($array_by_date as $key=> $data)
                <tr>
                    <td  class="width-stand text_small text-center" title="{{ $data[0]['stock']['companyName'] }}  - {{ $data[0]['stock']['industryName'] }}">{{ $key }}</td>
                    <?php $i = 0; ?>
                    @foreach($data as $t)
                    <?php 
                        $b_i = $i-1;
                        
                        // dd($data[$b_i]['thamchieu']);
                        $class_change = '';
                        if( $b_i > -1 && $t['thamchieu'] < $data[$b_i]['thamchieu']){
                            $class_change = 'giam';
                        }
                        if($b_i > -1 && $t['thamchieu'] > $data[$b_i]['thamchieu']){
                            $class_change = 'tang';
                        }
                        if($b_i > -1 && $t['thamchieu'] == $data[$b_i]['thamchieu']){
                            $class_change = 'bang';
                        }
                        // dd($data[$b_i]['thamchieu']);
                    ?>
                        <td class="width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }} {{ $class_change }}">{{ $t['thamchieu'] }}</td>
                        <td class="width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">{{ $t['khoiluong'] }}</td>
                        <td class="width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">{{ $t['nnmua'] }}</td>
                        <td class="width-stand text_small text-center {{ ($i%2==0)?'odd':'even' }}">{{ $t['nnban'] }}</td>
                        <?php $i++;  ?>
                    @endforeach
                    <td  class="font-weight-bold width-stand text_small text-center" >
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('display-vnindex',['category' => $t['stock']['industryName']])}}">Cùng Ngành</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
    </table>
@stop