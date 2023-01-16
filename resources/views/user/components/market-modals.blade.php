<div class="modal fade modal-background" id="choose-address" tabindex="-1" role="dialog" aria-labelledby="choose-address-label" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-450 modal-checkout modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="top">
                <h5>ყიდვა <i class="square"></i> <span>მისამართის არჩევა</span></h5>
                <i class="dark" id="times" data-dismiss="modal"></i>
            </div>
            <div class="middle">
                <div class="profile-item active d-fc">
                    <p class="name">შალვა მჭედლიშვილი</p>
                    <p class="number">599 156 156</p>
                    <p class="address"><strong>თბილისი</strong> / საბურთალო, ვაჟა ფშაველას 76</p>
                </div>
                <div class="profile-item d-fc">
                    <p class="name">შალვა მჭედლიშვილი</p>
                    <p class="number">599 156 156</p>
                    <p class="address"><strong>თბილისი</strong> / საბურთალო, ვაჟა ფშაველას 76</p>
                </div>
                <button type="button" class="add-new-address" data-dismiss="modal" data-toggle="modal" data-target="#add-new-address">ახალი მისამართის დამატება</button>
                <button class="market-buy" data-dismiss="modal" data-toggle="modal" data-target="#payment-method">გაგრძელება <i class="white" id="arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-background" id="add-new-address" tabindex="-1" role="dialog" aria-labelledby="add-new-address-label" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-450 modal-checkout modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="top">
                <h5>ახალი მისამართის დამატება</h5>
                <i class="dark" id="times" data-dismiss="modal"></i>
            </div>
            <div class="middle new-address">
                <div class="top">
                    <button type="button" class="active" data-toggle="physical">ფიზიკური პირი</button>
                    <button type="button" class="" data-toggle="legal">იურიდიული პირი</button>
                </div>
                <div class="form">
                    <input type="text" class="w-100" placeholder="სახელი">
                    <input type="text" class="small" placeholder="პირადი ნომერი">
                    <input type="text" class="small" placeholder="ტელეფონის ნომერი">
                </div>
                <div class="select-wrapper w-100">
                    <select class=" w-100" name="" id="">
                        <option value="" selected>აირჩიეთ ქალაქი</option>
                    </select>
                    <i class="orange" id="market-arrow"></i>
                </div>
                <input type="text" class="w-100" placeholder="მისამართის დეტალები (ქუჩა, კორპუსი, ...)">
                <div class="bottom double">
                    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#choose-address"><i class="dark-gray" id="arrow-right"></i></button>
                    <button class="market-buy">დამატება</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-background" id="payment-method" tabindex="-1" role="dialog" aria-labelledby="payment-method-label" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-450 modal-checkout modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="top">
                <h5>ყიდვა <i class="square"></i> <span>გადახდის მეთოდი</span></h5>
                <i class="dark" id="times" data-dismiss="modal"></i>
            </div>
            <div class="middle payment-method">
                <div class="line">
                    <p>პროდუქცია:</p>
                    <span>₾ <strong>54</strong></span>
                </div>
                <div class="line">
                    <p>მიტანა:</p>
                    <span>₾ <strong>6</strong></span>
                </div>
                <div class="line mb">
                    <p>სულ:</p>
                    <span class="total">₾ <strong>60</strong></span>
                </div>
                <div class="profile-item profile-card active d-flex">
                    <div class="left d-fc">
                        <p class="name">SHALVA MCHEDLISHVILI</p>
                        <p class="number">5992 **** **** 0027</p>
                        <p class="address"><strong>12/23</strong></p>
                    </div>
                    <div class="right">
                        <img src="{{ asset('images/logos/Mastercard-logo.svg') }}" alt="">
                    </div>
                </div>
                <div class="profile-item profile-card d-flex">
                    <div class="left d-fc">
                        <p class="name">SHALVA MCHEDLISHVILI</p>
                        <p class="number">5992 **** **** 0027</p>
                        <p class="address"><strong>12/23</strong></p>
                    </div>
                    <div class="right">
                        <img src="{{ asset('images/logos/VISA-logo.png') }}" alt="">
                    </div>
                </div>
                <button type="button" class="add-new-address" data-dismiss="modal" data-toggle="modal" data-target="#add-new-card">ახალი ბარათის დამატება</button>
                <div class="bottom double">
                    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#choose-address"><i class="dark-gray" id="arrow-right"></i></button>
                    <button class="market-buy">გადახდა</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-background" id="add-new-card" tabindex="-1" role="dialog" aria-labelledby="add-new-card-label" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-450 modal-checkout modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="top">
                <h5>ახალი ბარათის დამატება</h5>
                <i class="dark" id="times" data-dismiss="modal"></i>
            </div>
            <div class="middle add-new-card">
                <div class="top">
                    <input class="w-100" type="text" name="" placeholder="შეიყვანეთ ბარათის ნომერი">
                    <div class="select-wrapper">
                        <select name="" id="">
                            <option value="" selected>წელი</option>
                        </select>
                        <i class="orange" id="market-arrow"></i>
                    </div>
                    <div class="select-wrapper">
                        <select name="" id="">
                            <option value="" selected>თვე</option>
                        </select>
                        <i class="orange" id="market-arrow"></i>
                    </div>
                    <input class="small" type="text" name="" placeholder="CCV/CVC">
                    <input class="w-100 mb-0" type="text" name="" placeholder="შეიყვანეთ ბარათის მფლობელი">
                </div>
                <div class="bottom double">
                    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#payment-method"><i class="dark-gray" id="arrow-right"></i></button>
                    <button class="market-buy">გადახდა</button>
                </div>
            </div>
        </div>
    </div>
</div>