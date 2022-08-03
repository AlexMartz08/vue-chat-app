export default function buildVeeFormErrors(errors) {
  return Object.entries(errors).reduce((acc, [field, errors]) => {
    acc[field] = errors[0];

    return acc;
  }, {});
}
