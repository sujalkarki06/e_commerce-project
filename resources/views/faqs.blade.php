@extends('layouts.applayout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Frequently Asked Questions</h1>
    <div class="row">
        @foreach ($faqs as $faq)
            <div class="col-md-12 mb-3">
                <div class="faq-item bg-light p-3 border rounded">
                    <h3 class="font-weight-bold">{{ $faq->question }}</h3>
                    <p class="mb-0">{{ $faq->answer }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    .faq-item {
    background-color: #f9f9f9; /* Light background for FAQ items */
    padding: 15px; /* Padding around the FAQ content */
    border: 1px solid #ddd; /* Light border for FAQ items */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 10px; /* Space between FAQ items */
}

.faq-item h3 {
    margin-bottom: 10px; /* Space below the question */
    font-size: 18px; /* Font size for the question */
    color: #333; /* Dark color for the question */
}

.faq-item p {
    font-size: 16px; /* Font size for the answer */
    color: #666; /* Gray color for the answer text */
}

</style>