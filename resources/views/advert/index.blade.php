@extends('UI_new.master')
@push('styles')
<style>
    img {
        max-width: 100%;
        height: auto;
        vertical-align: bottom;
    }
</style>
@endpush

@section('content')
<div class="content-body" style="margin-top: 3em">
    <section id="header-footer">
        <div class="row match-height">
            @forelse($adverts as $ads)
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$ads->title}}</h4>
                    </div>
                    <img class="" src="{{asset('adverts/'.$ads->feature_image)}}" alt="Advert Image">
                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                        <span class="float-left">Author: {{$ads->author}}</span>
                        <span class="float-right btn-group-xs">
                            <a href="{{ route('advert.view', $ads->id) }}" class="card-link btn btn-primary">
                                View
                                 <i class="la la-eye" style="color: white"></i>
                            </a>
                            <a href="{{ route('advert.delete', $ads->id) }}" class="card-link btn btn-danger">
                                Delete
                                <i class="la la-trash-o" style="color: white"></i>
                            </a>
                        </span>
                        @if(preg_match('/pending payment/i', $ads->status->name))
                        <span class="float-right">
                            <button class="card-link btn btn-success make-payment" data-advert="{{ $ads->id_hash }}"
                                data-price="{{ $ads->price }}">
                                <i class="las la-money-bill-wave-alt"></i>
                                Make Payment (GH₵ {{ number_format($ads->price, 2) }})
                            </button>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">There are no adverts</h4>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        {!! $adverts->links() !!}
    </section>
</div>

{{-- payment modal --}}
@include('advert.payment_modal')

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        let id, price;
        $(".make-payment").click(function(){
            id = $(this).data("advert");
            $("#price").val($(this).data("price"));
            $('#payment-modal').modal('show');
        });

        $('#payment-form').submit(function(){
            $('#advert').val(id);
            $('#payment-modal').modal('hide');
            return true;
        });
    });
</script>
@endpush
