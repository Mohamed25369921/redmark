<section class="clients-section">
    <div class="icon-lines-5"></div>
    <div class="auto-container">
        <div class="outer-box">

            <div class="sponsors-outer">

                <ul class="clients-carousel owl-carousel owl-theme">
                    @foreach ($brands as $brand)
                        <li class="slide-item"> <a href="javascript:void;">
                            <img src="{{ url('uploads/brands/source/' . $brand->logo) }}" alt=""></a> </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
    </div>
</section>