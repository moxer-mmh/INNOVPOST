import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        account_number : '' ,
        card_number : '' ,
        exp_carte  : '' ,
        card_expiration_date : '' ,
        phone_number : '' ,
        password : ''
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit} className='flex flex-col gap-2'>
                <div>
                    <InputLabel htmlFor="account_number" value="Ccp"/>

                    <TextInput
                        id="account_number"
                        name="account_number"
                        value={data.account_number}
                        className="mt-1 block w-full"
                        autoComplete="account_number"
                        isFocused={true}
                        onChange={(e) => setData('account_number', e.target.value)}
                        required
                    />

                    <InputError message={errors.account_number} className="mt-2"/>
                </div>

                <div>
                    <InputLabel htmlFor="card_number" value="Numéro De Carte"/>

                    <TextInput
                        id="card_number"
                        name="card_number"
                        value={data.card_number}
                        className="mt-1 block w-full"
                        autoComplete="card_number"
                        isFocused={true}
                        onChange={(e) => setData('card_number', e.target.value)}
                        required
                    />

                    <InputError message={errors.card_number} className="mt-2"/>
                </div>
                <div className="mt-4">
                    <InputLabel htmlFor="card_expiration_date" value="Date D'expiration"/>


                    <TextInput
                        id="card_expiration_date"
                        type="month"
                        name="card_expiration_date"
                        value={data.card_expiration_date}
                        className="mt-1 block w-full"
                        autoComplete="card_expiration_date"
                        onChange={(e) => setData('card_expiration_date', e.target.value)}
                        required
                    />

                    <InputError message={errors.card_expiration_date} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="phone_number" value="Numéro Mobile Lié A La Carte"/>

                    <TextInput
                        id="phone_number"
                        type="text"
                        name="phone_number"
                        value={data.phone_number}
                        className="mt-1 block w-full"
                        autoComplete="phone_numer"
                        onChange={(e) => setData('phone_number', e.target.value)}
                        required
                    />

                    <InputError message={errors.phone_number} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Mot de Passe"/>

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2"/>
                </div>

                <div className="mt-4 flex items-center justify-end">
                    <Link
                        href={route('login')}
                        className="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton className="ms-4" disabled={processing}>
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
