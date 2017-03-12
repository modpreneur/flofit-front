<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 23.09.15
 * Time: 16:00
 */

namespace FloFitBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreditCardForm extends AbstractType
{
    const FORM_NAME = "stripe_view";
    const FIELD_FIRST_NAME = "first_name";
    const FIELD_LAST_NAME = "second_name";
    const FIELD_EMAIL = "email";
    const FIELD_CREDIT_CART = "credit_cart";
    const FIELD_CREDIT_SECURITY = "credit_cart_security";
    const FIELD_CREDIT_EXP_MONTH = "credit_cart_expiration_month";
    const FIELD_CREDIT_EXP_YEAR = "credit_cart_expiration_year";
    const FIELD_STRIPE_TOKEN = "stripe_token";

    /**
     * Build form function
     *
     * @param FormBuilderInterface $builder the formBuilder
     * @param array                $options the options for this form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_FIRST_NAME,"text")
            ->add(self::FIELD_LAST_NAME,"text")
            ->add(self::FIELD_EMAIL,"email")
            ->add(self::FIELD_CREDIT_CART, 'text', array(
                'required' => true,
                'max_length' => 20,
                "label"=> "Card number",
                'attr' => array("data-stripe"=>"number")
            ))
            ->add(self::FIELD_CREDIT_SECURITY, 'text', array(
                'required' => true,
                'max_length' => 4,
                "label"=> "CVC Code",
                'attr' => array("data-stripe"=>"cvc")
            ))
            ->add(self::FIELD_CREDIT_EXP_MONTH, 'choice', array(
                'required' => true,
                'choices' => array_combine(range(1, 12), range(1, 12)),
                "label"=> "Expiration month",
                'attr' => array("data-stripe"=>"exp-month")
            ))
            ->add(self::FIELD_CREDIT_EXP_YEAR, 'choice', array(
                'required' => true,
                'choices' => array_combine(range(date('Y'), 2025), range(date('Y'), 2025)),
                "label"=> "Expiration year",
                'attr' => array("data-stripe"=>"exp-year")
            ))
            ->add(self::FIELD_STRIPE_TOKEN, 'hidden')
            ->add('api_token', 'hidden', array(
                'data'  =>  ''
            ));
    }

    public static function getFieldName($fieldName)
    {
        return sprintf(self::FORM_NAME . "[%s]",$fieldName);
    }

    /**
     * Return unique name for this form
     *
     * @return string
     */
    public function getName()
    {
        return self::FORM_NAME;
    }
}