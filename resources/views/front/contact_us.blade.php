
@extends('layouts/nav')

@section('content')
<section class="mbr-section form1 cid-rSTobyvYqh pt-5 mt-5" id="form1-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    聯絡我們
                </h2>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">

            <div class="media-container-column col-lg-8" data-form-type="formoid">
                <!---Formbuilder Form--->
                <form action="/contact_us_store" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                    @csrf
                    <input type="hidden" name="email" data-form-email="true" value="">
                    <div class="row">

                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-md-4  form-group" data-for="name">
                            <label for="name-form1-4" class="form-control-label mbr-fonts-style display-7">姓名</label>
                            <input type="text" name="name" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-4">
                        </div>
                        <div class="col-md-4  form-group" data-for="email">
                            <label for="email-form1-4" class="form-control-label mbr-fonts-style display-7">信箱</label>
                            <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-4">
                        </div>
                        <div data-for="phone" class="col-md-4  form-group">
                            <label for="phone-form1-4" class="form-control-label mbr-fonts-style display-7">電話</label>
                            <input type="tel" name="phone" data-form-field="Phone" class="form-control display-7" id="phone-form1-4">
                        </div>
                        <div data-for="message" class="col-md-12 form-group">
                            <label for="message-form1-4" class="form-control-label mbr-fonts-style display-7">訊息</label>
                            <textarea name="message" data-form-field="Message" class="form-control display-7" id="message-form1-4"></textarea>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                {!! htmlFormSnippet() !!}
                            </div>
                        </div> --}}
                        <div class="col-md-12 input-group-btn align-center">
                            <button type="submit" class="btn btn-primary btn-form display-4">SEND FORM</button>
                        </div>
                    </div>
                </form><!---Formbuilder Form--->
            </div>
        </div>
    </div>
</section>
@endsection


