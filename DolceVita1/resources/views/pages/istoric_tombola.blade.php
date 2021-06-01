@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            @if($message=Session::get('success_message'))
            <div class="alert-success">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{$message}}</strong>
                </div>
            </div>
            @endif  
        </div>
        <div class="row d-flex justify-content-center">
            <main class="col-xl-9 col-lg-9 col-md-9 col-sm-9"> 
                <div class="card  p-2">
                    <table class="table-responsive table-hover shopping-cart-wrap p-1">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col" class="text-center" style="width:150px;">Denumire tombolă</th>
                                <th scope="col" class="text-center"style="width:110px;">Data început</th>
                                <th scope="col" class="text-center" style="width:130px;">Data închidere</th>
                                <th scope="col" class="text-center" style="width:110px;">Statut</th>
                                <th scope="col" class="text-center" style="width:110px;">Data creării</th>
                                <th scope="col" class="text-center" style="width:110px;">Număr participanți</th>
                            </tr>
                        </thead>                      
                    </table>
                </div>  <!--end card-2 -->
                <div class="list-group">
                <table>	
                    <tbody>
                    @foreach($raffles as $raffle)
                    <tr>
                        <article class="list-group-item">
                            <header class="filter-header">       
                                <div href="#" data-toggle="collapse" data-target="#collapse2">
                                    <i class="icon-action fa fa-chevron-down"></i>  
                                    <?php
                                        $users=DB::table('raffle_user')->where('raffle_id',$raffle->id)->count();
                                        $dateCreated=date_format(date_create($raffle->created_at),'Y-m-d');
                                    ?>
                                    <p><strong>{{$raffle->name}}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$raffle->date_start}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$raffle->date_end}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$raffle->status}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$dateCreated}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$users}}</p>                                                                                                     
                                </div>
                            </header>
                            
                            <?php
                                 $user=DB::table('raffle_user')->where(['raffle_id'=>$raffle->id,'status'=>1])->get();
                                 foreach($user as $u)
                                 {
                                    $userData=App\Models\User::find($u->user_id);
                                    
                                 }
                            ?>
                            @if($raffle->status ==0) <!--afisarea doar tombelor desfasurate //-->
                            <div class="filter-content collapse show" id="collapse2">
                            <p>Detaliile câștigătorului:</p>              
                            <p><strong>Nume:</strong>&nbsp; {{$userData->name}}&nbsp;&nbsp;&nbsp;<strong>Email:</strong>&nbsp;{{$userData->email}}</p>                                                                                                                                
                            </div>
                            @endif
                        </article>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div> <!-- list-group.// -->                       
            </main> <!-- col.// -->
        </div> <!-- end-row .//  -->
    </div> <!-- container .//  -->
</section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
