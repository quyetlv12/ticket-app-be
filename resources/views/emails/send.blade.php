@component('mail::message')
# Introduction

Dear {{$email->email}},

<div>Mã vé của bạn là : {{$email->ticket_code}}<br></div>
<div>Người đặt : {{$email->customer_name}}<br></div>
<div>Ngày khởi hành : {{$buse->date_active}}<br></div>
<div>Bắt đầu : {{$buse->startDistrict_name}}, {{$buse->startWard_name}}, {{$buse->startPointName}}<br></div>
<div>Điểm đến :  {{$buse->endDistrict_name}}, {{$buse->endWard_name}}, {{$buse->endPointName}}<br></div>
<div>Thời gian :  {{$buse->start_time}}<br></div>
<div>Giá : {{$email->totalPrice}}<br></div>
<div>Hình thức thanh toán : {{$email->paymentMethod}}<br></div>
<div>Số ghế : {{$email->quantity}}<br></div>


@component('mail::button', ['url' => 'https://fpoly-ticket-app.vercel.app/?'])
Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
