import { Component } from '@angular/core';
import { Snow } from './snow';

@Component({
    selector: 'my-app',
    template:  `
    <h1>Config your snowboard</h1>
    <div class="col-md-6">
        <h3>Brand</h3>
        <label>Name: </label>
        <input [(ngModel)]="snow.brand.name" class="form-control" placeholder="Burton">
        <label>Color: </label>
        <input [(ngModel)]="snow.brand.color" class="form-control" placeholder="Burton">
    </div>
    <div class="col-md-6">
        <h3>Color</h3>
        <label>Left: </label>
        <input [(ngModel)]="snow.color.top" class="form-control" placeholder="#ffeedd">
        <label>Mid: </label>
        <input [(ngModel)]="snow.color.mid" class="form-control" placeholder="#ffeedd">
        <label>Right: </label>
        <input [(ngModel)]="snow.color.bottom" class="form-control" placeholder="#ffeedd">
    </div>
    <div class="col-md-12 text-center">
        <div class="block">
            <h2 [style.color]="snow.brand.color">{{snow.brand.name}}</h2>
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="510.084px" height="510.084px" viewBox="0 0 510.084 510.084"  style="enable-background:new 0 0 510.084 510.084;"
     xml:space="preserve">
<g>
    <g>
        <path [attr.fill]="snow.color.mid" d="M180.866,428.238c27.023-31.978,68.334-78.327,98.475-108.726l37.428-37.763c30.141-30.408,76.137-72.148,107.836-99.44
			c15.271-13.158,30.734-25.102,44.973-36.768L362.717,39.628c-11.542,14.363-23.323,29.921-36.348,45.317
			c-27.014,31.948-68.353,78.298-98.484,108.716l-37.418,37.763c-30.131,30.408-76.108,72.139-107.817,99.44
			c-15.291,13.177-30.772,25.092-45.011,36.768l106.88,105.914C156.061,459.191,167.842,443.644,180.866,428.238z"/>
        <path [attr.fill]="snow.color.bottom" d="M26.03,486.474c0,0,29.261,33.631,72.273,20.617c5.814-1.76,11.284-4.246,16.601-7.172c0,0,17.365-10.48,19.938-13.11
			L25.083,377.06c-2.429,2.419-13.33,20.646-13.33,20.646c-2.859,5.346-5.307,10.844-7,16.687
			C-7.869,457.509,26.03,486.474,26.03,486.474z"/>
        <path [attr.fill]="snow.color.top" d="M505.331,95.693c12.623-43.117-21.286-72.082-21.286-72.082s-29.261-33.631-72.273-20.617
			c-5.813,1.759-11.293,4.246-16.6,7.172c0,0-17.366,10.48-19.929,13.11l109.759,109.749c2.419-2.429,13.32-20.646,13.32-20.646
			C501.172,107.043,503.629,101.536,505.331,95.693z"/>
    </g>
</g>
</svg>
        </div>
    </div>
  `,
})

export class AppComponent {
    snow: Snow = {
        id: 1,
        brand: {
            name: 'Quiksilver',
            color: '#2c9ad0',
        },
        color: {
            top : "#2c9ad0",
            mid : "#31708f",
            bottom : "#2c9ad0",
        }
    };
}