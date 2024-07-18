
<x-layout>

    <div class="flex justify-center flex items-center w-full" style="position:relative; overflow:hidden;">

        <div class="form-container mt-[calc(35vh-250px)]" style="height: 100%; width:400px;" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
            <p class="title">Register</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <x-errors title="We found {errors} validation error(s)" class="mb-4 mt-2 text-black/90" />
                <div class="input-group d-flex flex-column">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control w-100" id="name" placeholder="Name" {{ old('name') }} autocomplete="name">
                    @error('name')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="username" class="form-label">Username</label>
                    <input right-icon="user" placeholder="Username" name="username" />
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control w-100" id="email"
                        value="{{ session('registration_email') }}" placeholder="Email" {{ old('email') }} autocomplete="email">
                    @error('email')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group d-flex flex-column">
                    <x-inputs.password label="Password" name="password" placeholder="Password" value="" />
                    @error('password')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <x-inputs.password label="Confirm Password" name="password_confirmation" placeholder="Confirm Password" value="" />
                </div>
                <div class="flex justify-center items-center">
                    <hr style="border: 1px solid rgb(48, 48, 48); width: 90%" class="mt-5 mb-5">
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="input-group w-full" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="other">Other</option>
                    </select>
                     @error('gender')
                        <span class="text-rose-900">{{ $message }}</span>
                     @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="birthday" class="form-label">Date of Birth:</label>
                    <input type="date" name="birthday" class="form-control w-100" id="birthday">
                    @error('birthday')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="country" class="form-label">Country:</label>
                    <select name="country" class="input-group w-100" id="country">
                        <option value="">Select Country</option>
                    </select>
                    @error('country')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" name="city" class="form-control w-100" id="city">
                    @error('city')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <p class="text-[color:var(--quinary-color)] mt-2 mb-2">Already have an account? <a href="/login" style="color:var(--quaternary-color)">Login</a></p>
                <button class="sign">Register</button>
            </form>
        </div>
    </div>
</x-layout>

<script>
    var countries = [
        { code: 'AF', name: 'Afghanistan' },
        { code: 'AX', name: 'Åland Islands' },
        { code: 'AL', name: 'Albania' },
        { code: 'DZ', name: 'Algeria' },
        { code: 'AS', name: 'American Samoa' },
        { code: 'AD', name: 'Andorra' },
        { code: 'AO', name: 'Angola' },
        { code: 'AI', name: 'Anguilla' },
        { code: 'AQ', name: 'Antarctica' },
        { code: 'AG', name: 'Antigua and Barbuda' },
        { code: 'AR', name: 'Argentina' },
        { code: 'AM', name: 'Armenia' },
        { code: 'AW', name: 'Aruba' },
        { code: 'AU', name: 'Australia' },
        { code: 'AT', name: 'Austria' },
        { code: 'AZ', name: 'Azerbaijan' },
        { code: 'BS', name: 'Bahamas' },
        { code: 'BH', name: 'Bahrain' },
        { code: 'BD', name: 'Bangladesh' },
        { code: 'BB', name: 'Barbados' },
        { code: 'BY', name: 'Belarus' },
        { code: 'BE', name: 'Belgium' },
        { code: 'BZ', name: 'Belize' },
        { code: 'BJ', name: 'Benin' },
        { code: 'BM', name: 'Bermuda' },
        { code: 'BT', name: 'Bhutan' },
        { code: 'BO', name: 'Bolivia (Plurinational State of)' },
        { code: 'BQ', name: 'Bonaire, Sint Eustatius and Saba' },
        { code: 'BA', name: 'Bosnia and Herzegovina' },
        { code: 'BW', name: 'Botswana' },
        { code: 'BV', name: 'Bouvet Island' },
        { code: 'BR', name: 'Brazil' },
        { code: 'IO', name: 'British Indian Ocean Territory' },
        { code: 'BN', name: 'Brunei Darussalam' },
        { code: 'BG', name: 'Bulgaria' },
        { code: 'BF', name: 'Burkina Faso' },
        { code: 'BI', name: 'Burundi' },
        { code: 'CV', name: 'Cabo Verde' },
        { code: 'KH', name: 'Cambodia' },
        { code: 'CM', name: 'Cameroon' },
        { code: 'CA', name: 'Canada' },
        { code: 'KY', name: 'Cayman Islands' },
        { code: 'CF', name: 'Central African Republic' },
        { code: 'TD', name: 'Chad' },
        { code: 'CL', name: 'Chile' },
        { code: 'CN', name: 'China' },
        { code: 'CX', name: 'Christmas Island' },
        { code: 'CC', name: 'Cocos (Keeling) Islands' },
        { code: 'CO', name: 'Colombia' },
        { code: 'KM', name: 'Comoros' },
        { code: 'CG', name: 'Congo' },
        { code: 'CD', name: 'Congo (Democratic Republic of the)' },
        { code: 'CK', name: 'Cook Islands' },
        { code: 'CR', name: 'Costa Rica' },
        { code: 'CI', name: 'Côte d\'Ivoire' },
        { code: 'HR', name: 'Croatia' },
        { code: 'CU', name: 'Cuba' },
        { code: 'CW', name: 'Curaçao' },
        { code: 'CY', name: 'Cyprus' },
        { code: 'CZ', name: 'Czech Republic' },
        { code: 'DK', name: 'Denmark' },
        { code: 'DJ', name: 'Djibouti' },
        { code: 'DM', name: 'Dominica' },
        { code: 'DO', name: 'Dominican Republic' },
        { code: 'EC', name: 'Ecuador' },
        { code: 'EG', name: 'Egypt' },
        { code: 'SV', name: 'El Salvador' },
        { code: 'GQ', name: 'Equatorial Guinea' },
        { code: 'ER', name: 'Eritrea' },
        { code: 'EE', name: 'Estonia' },
        { code: 'ET', name: 'Ethiopia' },
        { code: 'FK', name: 'Falkland Islands (Malvinas)' },
        { code: 'FO', name: 'Faroe Islands' },
        { code: 'FJ', name: 'Fiji' },
        { code: 'FI', name: 'Finland' },
        { code: 'FR', name: 'France' },
        { code: 'GF', name: 'French Guiana' },
        { code: 'PF', name: 'French Polynesia' },
        { code: 'TF', name: 'French Southern Territories' },
        { code: 'GA', name: 'Gabon' },
        { code: 'GM', name: 'Gambia' },
        { code: 'GE', name: 'Georgia' },
        { code: 'DE', name: 'Germany' },
        { code: 'GH', name: 'Ghana' },
        { code: 'GI', name: 'Gibraltar' },
        { code: 'GR', name: 'Greece' },
        { code: 'GL', name: 'Greenland' },
        { code: 'GD', name: 'Grenada' },
        { code: 'GP', name: 'Guadeloupe' },
        { code: 'GU', name: 'Guam' },
        { code: 'GT', name: 'Guatemala' },
        { code: 'GG', name: 'Guernsey' },
        { code: 'GN', name: 'Guinea' },
        { code: 'GW', name: 'Guinea-Bissau' },
        { code: 'GY', name: 'Guyana' },
        { code: 'HT', name: 'Haiti' },
        { code: 'HM', name: 'Heard Island and McDonald Islands' },
        { code: 'VA', name: 'Holy See' },
        { code: 'HN', name: 'Honduras' },
        { code: 'HK', name: 'Hong Kong' },
        { code: 'HU', name: 'Hungary' },
        { code: 'IS', name: 'Iceland' },
        { code: 'IN', name: 'India' },
        { code: 'ID', name: 'Indonesia' },
        { code: 'IR', name: 'Iran (Islamic Republic of)' },
        { code: 'IQ', name: 'Iraq' },
        { code: 'IE', name: 'Ireland' },
        { code: 'IM', name: 'Isle of Man' },
        { code: 'IL', name: 'Israel' },
        { code: 'IT', name: 'Italy' },
        { code: 'JM', name: 'Jamaica' },
        { code: 'JP', name: 'Japan' },
        { code: 'JE', name: 'Jersey' },
        { code: 'JO', name: 'Jordan' },
        { code: 'KZ', name: 'Kazakhstan' },
        { code: 'KE', name: 'Kenya' },
        { code: 'KI', name: 'Kiribati' },
        { code: 'KP', name: 'Korea (Democratic People\'s Republic of)' },
        { code: 'KR', name: 'Korea (Republic of)' },
        { code: 'KW', name: 'Kuwait' },
        { code: 'KG', name: 'Kyrgyzstan' },
        { code: 'LA', name: 'Lao People\'s Democratic Republic' },
        { code: 'LV', name: 'Latvia' },
        { code: 'LB', name: 'Lebanon' },
        { code: 'LS', name: 'Lesotho' },
        { code: 'LR', name: 'Liberia' },
        { code: 'LY', name: 'Libya' },
        { code: 'LI', name: 'Liechtenstein' },
        { code: 'LT', name: 'Lithuania' },
        { code: 'LU', name: 'Luxembourg' },
        { code: 'MO', name: 'Macao' },
        { code: 'MK', name: 'Macedonia' },
        { code: 'MG', name: 'Madagascar' },
        { code: 'MW', name: 'Malawi' },
        { code: 'MY', name: 'Malaysia' },
        { code: 'MV', name: 'Maldives' },
        { code: 'ML', name: 'Mali' },
        { code: 'MT', name: 'Malta' },
        { code: 'MH', name: 'Marshall Islands' },
        { code: 'MQ', name: 'Martinique' },
        { code: 'MR', name: 'Mauritania' },
        { code: 'MU', name: 'Mauritius' },
        { code: 'YT', name: 'Mayotte' },
        { code: 'MX', name: 'Mexico' },
        { code: 'FM', name: 'Micronesia (Federated States of)' },
        { code: 'MD', name: 'Moldova (Republic of)' },
        { code: 'MC', name: 'Monaco' },
        { code: 'MN', name: 'Mongolia' },
        { code: 'ME', name: 'Montenegro' },
        { code: 'MS', name: 'Montserrat' },
        { code: 'MA', name: 'Morocco' },
        { code: 'MZ', name: 'Mozambique' },
        { code: 'MM', name: 'Myanmar' },
        { code: 'NA', name: 'Namibia' },
        { code: 'NR', name: 'Nauru' },
        { code: 'NP', name: 'Nepal' },
        { code: 'NL', name: 'Netherlands' },
        { code: 'NC', name: 'New Caledonia' },
        { code: 'NZ', name: 'New Zealand' },
        { code: 'NI', name: 'Nicaragua' },
        { code: 'NE', name: 'Niger' },
        { code: 'NG', name: 'Nigeria' },
        { code: 'NU', name: 'Niue' },
        { code: 'NF', name: 'Norfolk Island' },
        { code: 'MP', name: 'Northern Mariana Islands' },
        { code: 'NO', name: 'Norway' },
        { code: 'OM', name: 'Oman' },
        { code: 'PK', name: 'Pakistan' },
        { code: 'PW', name: 'Palau' },
        { code: 'PS', name: 'Palestine, State of' },
        { code: 'PA', name: 'Panama' },
        { code: 'PG', name: 'Papua New Guinea' },
        { code: 'PY', name: 'Paraguay' },
        { code: 'PE', name: 'Peru' },
        { code: 'PH', name: 'Philippines' },
        { code: 'PN', name: 'Pitcairn' },
        { code: 'PL', name: 'Poland' },
        { code: 'PT', name: 'Portugal' },
        { code: 'PR', name: 'Puerto Rico' },
        { code: 'QA', name: 'Qatar' },
        { code: 'RE', name: 'Réunion' },
        { code: 'RO', name: 'Romania' },
        { code: 'RU', name: 'Russian Federation' },
        { code: 'RW', name: 'Rwanda' },
        { code: 'BL', name: 'Saint Barthélemy' },
        { code: 'SH', name: 'Saint Helena, Ascension and Tristan da Cunha' },
        { code: 'KN', name: 'Saint Kitts and Nevis' },
        { code: 'LC', name: 'Saint Lucia' },
        { code: 'MF', name: 'Saint Martin (French part)' },
        { code: 'PM', name: 'Saint Pierre and Miquelon' },
        { code: 'VC', name: 'Saint Vincent and the Grenadines' },
        { code: 'WS', name: 'Samoa' },
        { code: 'SM', name: 'San Marino' },
        { code: 'ST', name: 'Sao Tome and Principe' },
        { code: 'SA', name: 'Saudi Arabia' },
        { code: 'SN', name: 'Senegal' },
        { code: 'RS', name: 'Serbia' },
        { code: 'SC', name: 'Seychelles' },
        { code: 'SL', name: 'Sierra Leone' },
        { code: 'SG', name: 'Singapore' },
        { code: 'SX', name: 'Sint Maarten (Dutch part)' },
        { code: 'SK', name: 'Slovakia' },
        { code: 'SI', name: 'Slovenia' },
        { code: 'SB', name: 'Solomon Islands' },
        { code: 'SO', name: 'Somalia' },
        { code: 'ZA', name: 'South Africa' },
        { code: 'GS', name: 'South Georgia and the South Sandwich Islands' },
        { code: 'SS', name: 'South Sudan' },
        { code: 'ES', name: 'Spain' },
        { code: 'LK', name: 'Sri Lanka' },
        { code: 'SD', name: 'Sudan' },
        { code: 'SR', name: 'Suriname' },
        { code: 'SJ', name: 'Svalbard and Jan Mayen' },
        { code: 'SE', name: 'Sweden' },
        { code: 'CH', name: 'Switzerland' },
        { code: 'SY', name: 'Syrian Arab Republic' },
        { code: 'TW', name: 'Taiwan' },
        { code: 'TJ', name: 'Tajikistan' },
        { code: 'TZ', name: 'Tanzania, United Republic of' },
        { code: 'TH', name: 'Thailand' },
        { code: 'TL', name: 'Timor-Leste' },
        { code: 'TG', name: 'Togo' },
        { code: 'TK', name: 'Tokelau' },
        { code: 'TO', name: 'Tonga' },
        { code: 'TT', name: 'Trinidad and Tobago' },
        { code: 'TN', name: 'Tunisia' },
        { code: 'TR', name: 'Turkey' },
        { code: 'TM', name: 'Turkmenistan' },
        { code: 'TC', name: 'Turks and Caicos Islands' },
        { code: 'TV', name: 'Tuvalu' },
        { code: 'UG', name: 'Uganda' },
        { code: 'UA', name: 'Ukraine' },
        { code: 'AE', name: 'United Arab Emirates' },
        { code: 'GB', name: 'United Kingdom' },
        { code: 'US', name: 'United States of America' },
        { code: 'UY', name: 'Uruguay' },
        { code: 'UZ', name: 'Uzbekistan' },
        { code: 'VU', name: 'Vanuatu' },
        { code: 'VE', name: 'Venezuela (Bolivarian Republic of)' },
        { code: 'VN', name: 'Viet Nam' },
        { code: 'WF', name: 'Wallis and Futuna' },
        { code: 'EH', name: 'Western Sahara' },
        { code: 'YE', name: 'Yemen' },
        { code: 'ZM', name: 'Zambia' },
        { code: 'ZW', name: 'Zimbabwe' }
    ];

    function populateCountries() {
        var select = document.getElementById("country");

        select.innerHTML = '<option value="">Select Country</option>';

        countries.forEach(function(country) {
            var option = document.createElement("option");
            option.value = country.code;
            option.textContent = country.name;
            select.appendChild(option);
        });
    }

    populateCountries();

    $(document).ready(function() {
        $('#country').select2({
            placeholder: "Select a country",
            allowClear: true,
            minimumResultsForSearch: Infinity
        });
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
