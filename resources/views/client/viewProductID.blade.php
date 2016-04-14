@extends('client/main')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{$product[0]->title}}</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- area -->
                        @foreach ($product as $item)
                                    <div id='productDescription' style='text-align:center;' data-product-id='{{$item->id}}'>
                                        {{$item->description}}
                                    </div>
                                    <hr>
                                    <div id='priceSchematic' style='text-align:center;' data-product-id='{{$item->id}}'>
                                        @if($item->setup_fee != '0')
                                            <b>Setup Fee: </b> ${{$item->setup_fee}}<br>
                                        @endif
                                        @if($item->one_time_fee != '0')
                                            <b>One-Time Fee: </b> ${{$item->one_time_fee}}<br>
                                        @endif
                                        @if($item->monthly_fee != '0')
                                            <b>Monthly Fee: </b> ${{$item->monthly_fee}}<br>
                                        @endif
                                        @if($item->semi_fee != '0')
                                            <b>Semi-Yearly Fee: </b> ${{$item->semi_fee}}<br>
                                        @endif
                                        @if($item->yearly_fee != '0')
                                            <b>Yearly Fee: </b> ${{$item->yearly_fee}}<br>
                                        @endif
                                        @if($item->stock != '1000')
                                            <b>Stock: </b> {{$item->stock}}<br>
                                        @endif
                                        <hr>
                                        @if($item->stock == '0')
                                            <button disabled>Out of Stock</button>
                                        @else
                                            @if($item->monthly_fee != '0')
                                                <a href="{{asset('/client/order/')}}/{{$item->id}}/monthly" class="btn btn-primary">Purchase Monthly Subscription (${{number_format($item->setup_fee+$item->monthly_fee,2)}})</a><br><br>
                                            @endif
                                            @if($item->semi_fee != '0')
                                                <a href="{{asset('/client/order/')}}/{{$item->id}}/semi" class="btn btn-primary">Purchase Semi-Yearly Subscription (${{number_format($item->setup_fee+$item->semi_fee,2)}})</a><br><br>
                                            @endif
                                            @if($item->yearly_fee != '0')
                                                <a href="{{asset('/client/order/')}}/{{$item->id}}/yearly" class="btn btn-primary">Purchase Yearly Subscription (${{number_format($item->setup_fee+$item->yearly_fee,2)}})</a><br>
                                            @endif
                                        @endif
                                    </div>
                                
                        @endforeach
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection