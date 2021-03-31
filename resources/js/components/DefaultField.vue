<template>

    <div ref="field-wrapper" :class="this.field.size"> <!-- ADD this.field.size to this div -->
        <field-wrapper>
            <div :class="fieldWrapperClasses">

                <div :class="fieldLabelClasses">
                    <slot>
                        <form-label
                            :label-for="field.attribute"
                            :class="{ 'mb-2': showHelpText && field.helpText }"
                        >
                            {{ fieldLabel }}&nbsp;<span
                                v-if="field.required"
                                class="text-danger text-sm"
                                >{{ __('*') }}</span
                            >
                        </form-label>
                    </slot>
                </div>
                <div :class="fieldClasses">
                    <slot name="field" />

                    <help-text class="error-text mt-2 text-danger" v-if="showErrors && hasError">
                        {{ firstError }}
                    </help-text>

                    <help-text class="help-text mt-2" v-if="showHelpText"> {{ field.helpText }} </help-text>
                </div>

            </div>
        </field-wrapper>
    </div>


</template>

<script>
    import { HandlesValidationErrors, Errors } from 'laravel-nova'

    export default {
        mixins: [HandlesValidationErrors],

        props: {
            field: { type: Object, required: true },
            fieldName: { type: String },
            showHelpText: { type: Boolean, default: true },
            showErrors: { type: Boolean, default: true },
            fullWidthContent: { type: Boolean, default: false },
        },

        data:() => ({
            ready: false,
        }),

        mounted() {
            if (this.hasSize) {
                this.$parent.$parent.$el.classList.add('nova-grid-card-styles');
                // this.$refs['field-wrapper'].parentNode.classList.add(this.field.size)  //COMMENT THIS OUT
            }
        },

        computed: {
            fieldLabel() {
                // If the field name is purposefully an empty string, then
                // let's show it as such
                if (this.fieldName === '') {
                    return ''
                }

                return this.fieldName || this.field.singularLabel || this.field.name
            },

            hasSize() {
                return this.field.size !== undefined;
            },

            fieldLabelClasses() {
                return this.hasSize ? 'nova-grid-field-label' : 'w-1/5 py-6 px-8';
            },

            fieldWrapperClasses() {
                return this.field.size !== undefined ? 'nova-grid-wrapper' : 'flex border-b border-40 w-full';
            },

            fieldClasses() {

                if(this.hasSize) {
                    return 'w-full';
                }

                return this.fullWidthContent ? 'py-6 px-8 w-4/5' : 'py-6 px-8 w-1/2'
            },
        },
    }
</script>
<style lang="scss">

    .nova-grid-wrapper {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        padding: 1rem;

    }

    .nova-grid-field-label {
        font-weight: 700;
        margin-bottom: 0.5rem;
        width: 100%;
    }

    .nova-grid-card-styles {
        display: flex; //ADDED
        flex-wrap: wrap; //ADDED
        width: 100%; //ADDED

        > form {
            display: flex;
            flex-wrap: wrap;
            width: 100%;

            .bg-30.flex.px-8.py-4 {
                width: 100%;
                display: flex;
                justify-content: flex-end;
            }

        }

    }


</style>
