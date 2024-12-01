import { SVGAttributes } from 'react';

export default function ApplicationLogo(props: SVGAttributes<SVGElement>) {
    return (
        <img src='/algerie_poste.svg' {...props} />
    );
}
