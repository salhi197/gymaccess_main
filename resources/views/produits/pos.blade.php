@extends('layouts.master')

@section('content')
                        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                <div class="card-header">
                      <div class="col--md-4">

                      </div>


                </div>

                <div class="card">
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10px">id</th>
                          <th>Produit</th>
                          <th>Quantité</th>
                          <th>Prix</th>

                        </tr>
                      </thead>
                      <tbody id="tablebody">
<!--                         <tr>
                          <td>1.</td>
                          <td>Update software</td>
                          <td>h</td>
                          <td>7</td>
                          <td>90</td>
                        </tr>
                        <tr>
                          <td>2.</td>
                          <td>Update software</td>
                          <td>h</td>
                          <td>7</td>
                          <td>90</td>
                        </tr>
 -->                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <label for=""><p>Total</p></label>
                      </div>
                      <div class="col-3 col-sm-3 col-md-3 col-offset-2 col-lg-3">
                        <div class="input-group input-group-sm mb-1">
                          <h3 id="total">

                          </h3>
                        </div>
                       
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <label for=""><p>Remise</p></label>
                      </div>
                      <div class="col-3 col-sm-3 col-md-3 col-offset-2 col-lg-3">
                        <div class="input-group input-group-sm ">
                          <input class="form-control" name="remise" id="remise" type="number" placeholder="remise"/>
                        </div>
                       
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <label for=""><p>Total Final</p></label>
                      </div>
                      <div class="col-3 col-sm-3 col-md-3 col-offset-2 col-lg-3">
                        <div class="input-group input-group-sm ">
                          <h3 id="newtotal">
                          </h3>

                        </div>
                       
                      </div>
                    </div>

                    <div class="text-center">
                      <button href="#" class="btn btn-info" id="btnvalider"  ><i class="fa fa-check"></i> Valider</button>
                      <button onClick="window.location.reload();" class="btn btn-danger"><i class="fa fa-trash"></i> Annuler</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                <div class="input-group">
                  <br>
                  <input type="text" id="searchproduct" class="form-control" placeholder="Search">
                </div>
                <div class="row">
                @foreach($produits as $produit)
                  <div class="col-6 col-sm-6 col-md-3 col-lg-3 mt-2 produitclass produitid{{$produit->id}}" >
                    <div class="card p-0 m-0">
                      <div class="card-body p-0 m-0 b-0" class="photo" id="{{$produit->id}}">
                        <img src="{{asset('default.png')}}" alt="" class="img-thumbnail">
                      </div>
                      <div class="title">
                        <h2 class="names" id="{{$produit->id}}">
                        {{$produit->nom ?? ''}} 
                        </h2>
                      </div>
                      <div class="card-footer cf">
                        <div class="row">
                          <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <span class="price">
                              <h3>
                              {{$produit->prix_vente ?? '0'}} DA 
                              </h3>

                              </span>
                          </div>
                          <div class="col-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <a href="#" class="btn btn-info btnadd" id="{{$produit->id ?? ''}}" >
                              <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger btnremove" id="{{$produit->id ?? ''}}"  >   
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </a>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                  
                 
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.Left col -->
  </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

@endsection


@section('scripts')
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>


<script>
    function renderTable(elts){
            var trHTML = '';
            $.each(elts, function (i, item) {
                if(item.qte>0){
                    trHTML += '<tr>' +  
                        '<td style="font-size:30px;">' + item.numero + '</td>' +
                        '<td style="font-size:30px;">' + item.name + '</td>' +
                        '<td style="font-size:30px;">' + item.qte + '</td>' +
                        '<td style="font-size:30px;">' + item.prix + ' DA</td>' +
                        '</tr>';

                }
            });

            $('#tablebody').append(trHTML);
    }

    function calculateSum(elts){
        var total=0;
        for (var i = 0; i < elts.length; i++) {
            total = total + elts[i].qte*elts[i].prix
        }
        $('#total').html(total+' DA ')
    }
    $(document).ready(function() {

          $('.js-example-basic-single').select2({
            'width':"100%"
          });
        var pos=-1;
       const jsonObj = [
            @foreach ($produits as $produit)
                {codebar:<?php echo json_decode($produit->codebar); ?>,numero:<?php echo json_decode($produit->id); ?>,name:'{{$produit->nom}}',prix:<?php echo json_decode($produit->prix_vente); ?>, qte: 0,max:<?php echo json_decode($produit->qte); ?>},
            @endforeach
       ]
       console.log(jsonObj)

        $('.btnadd').on('click',function() {
            $('#tablebody').html('');

            console.log('ajouter :  '+this.id)
            for (var i = 0; i < jsonObj.length; i++) {
                pos = i;
              if (jsonObj[i].numero == this.id) {
                if(jsonObj[i].max<=jsonObj[i].qte){
                        // toastr.error("Hors Stock")
                }
                jsonObj[i].qte = jsonObj[i].qte+1;
                break;
              }
            }
           console.log(jsonObj)
           renderTable(jsonObj)
           calculateSum(jsonObj)


        })

        /////////////////////////////


        $('#remise').on('keyup',function () {
          if(this.value.length==0){
            $('#newtotal').html(parseInt($('#total').html())+'DA')
          }else{
            $('#newtotal').html(parseInt($('#total').html())-parseInt(this.value)+'DA')
          }
        })


        $('#searchproduct').on('change',function(){
         console.log($('#searchproduct').val())
          if($('#searchproduct').val().length == 0){
            $('.produitclass').show()            
          }else{
            // $('.produitclass').hide()            

            
            // for (var i = 0; i < jsonObj.length; i++) {
            //     pos = i;
            //   if (jsonObj[i].name.toLowerCase().indexOf($('#searchproduct').val())>-1) {
            //     $('.produitid'+jsonObj[i].numero).show()
            //   }
            // }


            $('#tablebody').html('');

            // console.log('ajouter :  '+this.id)
            for (var i = 0; i < jsonObj.length; i++) {
                pos = i;
              if (jsonObj[i].codebar == $('#searchproduct').val()) {
                if(jsonObj[i].max<=jsonObj[i].qte){
                        // toastr.error("Hors Stock")
                }
                jsonObj[i].qte = jsonObj[i].qte+1;
                break;
              }
            }

         $('#searchproduct').val('')


          }

           renderTable(jsonObj)
           calculateSum(jsonObj)

        })
        $('.btnremove').on('click',function () {
            $('#tablebody').html('');

            console.log('remove :  '+this.id)
            for (var i = 0; i < jsonObj.length; i++) {
                pos = i;
              if (jsonObj[i].numero == this.id) {

                jsonObj[i].qte = jsonObj[i].qte-1;
                break;
              }
            }
           console.log(jsonObj)

           renderTable(jsonObj)
           calculateSum(jsonObj)



        })
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');



            $('#btnvalider').click( function() {
                console.log(JSON.stringify(jsonObj),$( "#membre" ).val(),CSRF_TOKEN)
                $.ajax({
                  type: 'POST',
                  data: {
                    elements: JSON.stringify(jsonObj),
                    membre:$( "#membre" ).val(),
                    _token: CSRF_TOKEN,
                    total:$('#total').html(),
                    remise:$('#remise').val()},

                  dataType: 'JSON', 
                  url: "/pos",
                  success: function(msg){
                    console.log("success")
                    $('#tablebody').html('');
                    $('#total').html('');
                    $( "#membre" ).val(0)
                    $('#remise').val(0);
                    $('#newtotal').html('')

                    for (var i = 0; i < jsonObj.length; i++) {
                        jsonObj[i].qte = 0;
                    }

                        toastr.success('Insére')
                      
                  },
                  error:function(err){
                        toastr.error("err")
                  }
                });
            });
    })


</script>

@endsection