import { Component, Input } from '@angular/core';

import { Snow } from './snow';

@Component({
    selector: 'snow-detail',
})
export class SnowDetailComponent {
    @Input()
    snow: Snow;
}