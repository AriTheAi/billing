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
              <h3 class="box-title">Products</h3>
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
                    <div class='row'>
                        @foreach ($products as $product)
                            @if($product->visible == '1')
                                <div class='col-md-3' style='border:1px dashed #ffe;'>
                                    <b>{{$product->title}}</b><hr>
                                    <div id='productDescription' style='text-align:center;' data-product-id='{{$product->id}}'>
                                        {{$product->description}}
                                    </div>
                                    <hr>
                                    <b>Pricing</b><br>
                                    <div id='priceSchematic' style='text-align:center;' data-product-id='{{$product->id}}'>
                                        @if($product->setup_fee != '0')
                                            <b>Setup Fee: </b> ${{$product->setup_fee}}<br>
                                        @endif
                                        @if($product->one_time_fee != '0')
                                            <b>One-Time Fee: </b> ${{$product->one_time_fee}}<br>
                                        @endif
                                        @if($product->monthly_fee != '0')
                                            <b>Monthly Fee: </b> ${{$product->monthly_fee}}<br>
                                        @endif
                                        @if($product->semi_fee != '0')
                                            <b>Semi-Yearly Fee: </b> ${{$product->semi_fee}}<br>
                                        @endif
                                        @if($product->yearly_fee != '0')
                                            <b>Yearly Fee: </b> ${{$product->yearly_fee}}<br>
                                        @endif
                                        @if($product->stock != '1000')
                                            <b>Stock: </b> {{$product->stock}}<br>
                                        @endif
                                        @if($product->stock == '0')
                                            <button disabled>Out of Stock</button>
                                        @else
                                            <a href="{{asset('/client/product/')}}/{{$product->id}}" class="btn btn-md btn-primary form-control">Order</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>   
                    {!! $products->render() !!}
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