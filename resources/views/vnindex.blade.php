@extends('layout')
@section('content')
    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <?php $i =0;  ?>
                @foreach($data_date as $date)
                <th></th>
                    <th class="text_small text-center {{ ($i%2==0)?'odd':'even' }}" colspan="4">{{ $date }}</th>
                    <?php $i++; ?>
                @endforeach
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
            </tr>
            @foreach($array_by_date as $key=> $data)
                <tr>
                    <td  class="width-stand text_small text-center">{{ $key }}</td>
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
                </tr>
            @endforeach
            </tbody>
    </table>
@stop